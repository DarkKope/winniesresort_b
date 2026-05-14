<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    private function checkAdmin()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        return null;
    }
    
    public function dashboard()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        
        $total_bookings = $db->query("SELECT COUNT(*) as count FROM bookings")->getRowArray();
        $pending_bookings = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'pending'")->getRowArray();
        $confirmed_bookings = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'confirmed'")->getRowArray();
        $completed_bookings = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'completed'")->getRowArray();
        $cancelled_bookings = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'cancelled'")->getRowArray();
        $total_cottages = $db->query("SELECT COUNT(*) as count FROM cottages")->getRowArray();
        $total_customers = $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'")->getRowArray();
        $total_revenue = $db->query("SELECT SUM(total_amount) as total FROM bookings WHERE status != 'cancelled'")->getRowArray();
        
        $recent = $db->query("SELECT b.*, c.cottage_name, u.full_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id 
            ORDER BY b.created_at DESC LIMIT 10")->getResultArray();
        
        $data = [
            'title' => 'Admin Dashboard',
            'total_bookings' => $total_bookings['count'] ?? 0,
            'pending_bookings' => $pending_bookings['count'] ?? 0,
            'confirmed_bookings' => $confirmed_bookings['count'] ?? 0,
            'completed_bookings' => $completed_bookings['count'] ?? 0,
            'cancelled_bookings' => $cancelled_bookings['count'] ?? 0,
            'total_cottages' => $total_cottages['count'] ?? 0,
            'total_customers' => $total_customers['count'] ?? 0,
            'total_revenue' => $total_revenue['total'] ?? 0,
            'recent_bookings' => $recent
        ];
        
        return view('admin/dashboard', $data);
    }
    
    public function cottages()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages ORDER BY cottage_id DESC")->getResultArray();
        
        $data = [
            'title' => 'Manage Cottages',
            'cottages' => $cottages
        ];
        
        return view('admin/cottages', $data);
    }
    
    public function addCottage()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        return view('admin/add_cottage', ['title' => 'Add Cottage']);
    }
    
    public function saveCottage()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        
        $db->query("INSERT INTO cottages (cottage_name, description, price_per_day, capacity, status) 
                    VALUES (?, ?, ?, ?, ?)",
                    [$this->request->getPost('cottage_name'), 
                     $this->request->getPost('description'),
                     $this->request->getPost('price_per_day'), 
                     $this->request->getPost('capacity'),
                     $this->request->getPost('status')]);
        
        session()->setFlashdata('success', 'Cottage added successfully');
        return redirect()->to('/admin/cottages');
    }
    
    public function editCottage($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        
        $data = [
            'title' => 'Edit Cottage',
            'cottage' => $cottage
        ];
        
        return view('admin/edit_cottage', $data);
    }
    
    public function updateCottage($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        
        $db->query("UPDATE cottages SET cottage_name=?, description=?, price_per_day=?, capacity=?, status=? WHERE cottage_id=?",
                    [$this->request->getPost('cottage_name'), 
                     $this->request->getPost('description'),
                     $this->request->getPost('price_per_day'), 
                     $this->request->getPost('capacity'),
                     $this->request->getPost('status'), $id]);
        
        session()->setFlashdata('success', 'Cottage updated successfully');
        return redirect()->to('/admin/cottages');
    }
    
    public function deleteCottage($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("DELETE FROM cottages WHERE cottage_id = ?", [$id]);
        
        session()->setFlashdata('success', 'Cottage deleted successfully');
        return redirect()->to('/admin/cottages');
    }
    
    public function bookings()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $bookings = $db->query("SELECT b.*, c.cottage_name, u.full_name, u.email, u.phone FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id 
            ORDER BY b.created_at DESC")->getResultArray();
        
        $data = [
            'title' => 'Manage Bookings',
            'bookings' => $bookings
        ];
        
        return view('admin/bookings', $data);
    }
    
    public function viewBooking($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $booking = $db->query("SELECT b.*, c.cottage_name, c.price_per_day, u.full_name, u.email, u.phone 
            FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id 
            WHERE b.booking_id = ?", [$id])->getRowArray();
        
        $data = [
            'title' => 'Booking Details',
            'booking' => $booking
        ];
        
        return view('admin/view_booking', $data);
    }
    
    public function updateBookingStatus()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET status = ? WHERE booking_id = ?",
                    [$this->request->getPost('status'), $this->request->getPost('booking_id')]);
        
        session()->setFlashdata('success', 'Booking status updated');
        return redirect()->to('/admin/bookings');
    }
    
    public function users()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $users = $db->query("SELECT user_id, username, email, full_name, phone, role, created_at FROM users ORDER BY user_id DESC")->getResultArray();
        
        $data = [
            'title' => 'Manage Users',
            'users' => $users
        ];
        
        return view('admin/users', $data);
    }
}