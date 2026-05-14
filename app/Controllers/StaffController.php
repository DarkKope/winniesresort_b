<?php

namespace App\Controllers;

class StaffController extends BaseController
{
    private function checkStaff()
    {
        if (!session()->get('logged_in') || (session()->get('role') != 'staff' && session()->get('role') != 'admin')) {
            return redirect()->to('/');
        }
        return null;
    }
    
    public function dashboard()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $total_bookings = $db->query("SELECT COUNT(*) as count FROM bookings")->getRowArray();
        $pending_bookings = $db->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'pending'")->getRowArray();
        $total_cottages = $db->query("SELECT COUNT(*) as count FROM cottages")->getRowArray();
        
        $data = [
            'total_bookings' => $total_bookings['count'] ?? 0,
            'pending_bookings' => $pending_bookings['count'] ?? 0,
            'total_cottages' => $total_cottages['count'] ?? 0
        ];
        
        return view('staff/dashboard', $data);
    }
    
    public function bookings()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $bookings = $db->query("SELECT b.*, c.cottage_name, u.full_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id ORDER BY b.created_at DESC")->getResultArray();
        
        return view('staff/bookings', ['bookings' => $bookings]);
    }
    
    public function viewBooking($id)
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $booking = $db->query("SELECT b.*, c.cottage_name, u.full_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            JOIN users u ON b.user_id = u.user_id WHERE b.booking_id = ?", [$id])->getRowArray();
        
        return view('staff/view_booking', ['booking' => $booking]);
    }
    
    public function updateBookingStatus()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET status = ? WHERE booking_id = ?",
            [$this->request->getPost('status'), $this->request->getPost('booking_id')]);
        
        session()->setFlashdata('success', 'Status updated');
        return redirect()->to('/staff/bookings');
    }
    
    public function cottages()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages ORDER BY cottage_id DESC")->getResultArray();
        return view('staff/cottages', ['cottages' => $cottages]);
    }
    
    public function addCottage()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        return view('staff/add_cottage');
    }
    
    public function saveCottage()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("INSERT INTO cottages (cottage_name, description, price_per_day, capacity, status) VALUES (?, ?, ?, ?, ?)",
            [$this->request->getPost('cottage_name'), $this->request->getPost('description'),
             $this->request->getPost('price_per_day'), $this->request->getPost('capacity'),
             $this->request->getPost('status')]);
        
        session()->setFlashdata('success', 'Cottage added');
        return redirect()->to('/staff/cottages');
    }
    
    public function editCottage($id)
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        return view('staff/edit_cottage', ['cottage' => $cottage]);
    }
    
    public function updateCottage($id)
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("UPDATE cottages SET cottage_name=?, description=?, price_per_day=?, capacity=?, status=? WHERE cottage_id=?",
            [$this->request->getPost('cottage_name'), $this->request->getPost('description'),
             $this->request->getPost('price_per_day'), $this->request->getPost('capacity'),
             $this->request->getPost('status'), $id]);
        
        session()->setFlashdata('success', 'Cottage updated');
        return redirect()->to('/staff/cottages');
    }
    
    public function deleteCottage($id)
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("DELETE FROM cottages WHERE cottage_id = ?", [$id]);
        
        session()->setFlashdata('success', 'Cottage deleted');
        return redirect()->to('/staff/cottages');
    }
    
    public function profile()
    {
        $redirect = $this->checkStaff();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $user = $db->query("SELECT * FROM users WHERE user_id = ?", [session()->get('user_id')])->getRowArray();
        return view('staff/profile', ['user' => $user]);
    }
}