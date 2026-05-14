<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Check if logged in as admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        
        $total_bookings = $db->query("SELECT COUNT(*) as count FROM bookings")->getRowArray();
        $pending_bookings = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'pending'")->getRowArray();
        $total_cottages = $db->query("SELECT COUNT(*) as count FROM cottages")->getRowArray();
        $total_customers = $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'")->getRowArray();
        $total_revenue = $db->query("SELECT SUM(total_amount) as total FROM bookings WHERE status != 'cancelled'")->getRowArray();
        
        $recent = $db->query("SELECT b.*, c.cottage_name, u.full_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id 
            ORDER BY b.created_at DESC LIMIT 10")->getResultArray();
        
        $data = [
            'total_bookings' => $total_bookings['count'] ?? 0,
            'pending_bookings' => $pending_bookings['count'] ?? 0,
            'total_cottages' => $total_cottages['count'] ?? 0,
            'total_customers' => $total_customers['count'] ?? 0,
            'total_revenue' => $total_revenue['total'] ?? 0,
            'recent_bookings' => $recent
        ];
        
        return view('admin/dashboard', $data);
    }
    
    public function cottages()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages ORDER BY cottage_id DESC")->getResultArray();
        return view('admin/cottages', ['cottages' => $cottages]);
    }
    
    public function addCottage()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        return view('admin/add_cottage');
    }
    
   public function saveCottage()
{
    $db = \Config\Database::connect();
    
    $db->query("INSERT INTO cottages (cottage_name, description, price_per_day, capacity, status, image_url) 
                VALUES (?, ?, ?, ?, ?, ?)",
                [$this->request->getPost('cottage_name'), 
                 $this->request->getPost('description'),
                 $this->request->getPost('price_per_day'), 
                 $this->request->getPost('capacity'),
                 $this->request->getPost('status'),
                 $this->request->getPost('image_url')]);
    
    session()->setFlashdata('success', 'Cottage added');
    return redirect()->to('/admin/cottages');
}

public function updateCottage($id)
{
    $db = \Config\Database::connect();
    
    $db->query("UPDATE cottages SET cottage_name=?, description=?, price_per_day=?, capacity=?, status=?, image_url=? WHERE cottage_id=?",
                [$this->request->getPost('cottage_name'), 
                 $this->request->getPost('description'),
                 $this->request->getPost('price_per_day'), 
                 $this->request->getPost('capacity'),
                 $this->request->getPost('status'),
                 $this->request->getPost('image_url'), $id]);
    
    session()->setFlashdata('success', 'Cottage updated');
    return redirect()->to('/admin/cottages');
}
    public function editCottage($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        return view('admin/edit_cottage', ['cottage' => $cottage]);
    }
    
   
    
    public function deleteCottage($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $db->query("DELETE FROM cottages WHERE cottage_id = ?", [$id]);
        
        session()->setFlashdata('success', 'Cottage deleted');
        return redirect()->to('/admin/cottages');
    }
    
    public function bookings()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $bookings = $db->query("SELECT b.*, c.cottage_name, u.full_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id ORDER BY b.created_at DESC")->getResultArray();
        
        return view('admin/bookings', ['bookings' => $bookings]);
    }
    
   public function viewBooking($id)
{
    $db = \Config\Database::connect();
    $booking = $db->query("SELECT b.*, c.cottage_name, c.price_per_day, u.full_name, u.email, u.phone 
        FROM bookings b 
        JOIN cottages c ON b.cottage_id = c.cottage_id 
        JOIN users u ON b.user_id = u.user_id 
        WHERE b.booking_id = ?", [$id])->getRowArray();
    
    return view('admin/view_booking', ['booking' => $booking]);
}
    public function updateBookingStatus()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET status = ? WHERE booking_id = ?",
            [$this->request->getPost('status'), $this->request->getPost('booking_id')]);
        
        session()->setFlashdata('success', 'Status updated');
        return redirect()->to('/admin/bookings');
    }
    
    public function users()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $users = $db->query("SELECT * FROM users ORDER BY user_id DESC")->getResultArray();
        return view('admin/users', ['users' => $users]);
    }

    public function verifyPayment($id)
{
    $db = \Config\Database::connect();
    $db->query("UPDATE bookings SET payment_status = 'paid', payment_date = NOW() WHERE booking_id = ?", [$id]);
    
    session()->setFlashdata('success', 'Payment verified successfully!');
    return redirect()->to('/admin/bookings');
}
}