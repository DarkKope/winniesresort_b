<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        
        $cottages = $db->query("SELECT * FROM cottages WHERE status = 'available' ORDER BY price_per_day ASC")->getResultArray();
        
        $stats = null;
        if (session()->get('logged_in')) {
            $user_id = session()->get('user_id');
            $statsQuery = $db->query("SELECT 
                SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as total_bookings,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled
                FROM bookings WHERE user_id = ?", [$user_id]);
            $stats = $statsQuery->getRowArray();
            
            if (!$stats) {
                $stats = ['total_bookings' => 0, 'pending' => 0, 'confirmed' => 0, 'completed' => 0, 'cancelled' => 0];
            }
        }
        
        $data = [
            'title' => 'Winnie\'s Resort',
            'cottages' => $cottages,
            'stats' => $stats,
            'isLoggedIn' => session()->get('logged_in') ? true : false,
            'user' => session()->get()
        ];
        
        return view('customer/dashboard_main', $data);
    }
    
    public function viewCottage($id)
    {
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        
        if (!$cottage) {
            return redirect()->to('/');
        }
        
        $data = [
            'title' => $cottage['cottage_name'],
            'cottage' => $cottage,
            'isLoggedIn' => session()->get('logged_in') ? true : false
        ];
        
        return view('customer/cottage_detail', $data);
    }
    
    public function saveBooking()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first']);
        }
        
        $db = \Config\Database::connect();
        
        $cottage_id = $this->request->getPost('cottage_id');
        $check_in = $this->request->getPost('check_in');
        $check_out = $this->request->getPost('check_out');
        $special_requests = $this->request->getPost('special_requests') ?? '';
        
        if (!$cottage_id || !$check_in || !$check_out) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please fill in all fields']);
        }
        
        $start = new \DateTime($check_in);
        $end = new \DateTime($check_out);
        $days = $start->diff($end)->days;
        
        if ($days <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Check-out must be after check-in']);
        }
        
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$cottage_id])->getRowArray();
        $total = $days * $cottage['price_per_day'];
        
        $user = $db->query("SELECT * FROM users WHERE user_id = ?", [session()->get('user_id')])->getRowArray();
        
        $ref = 'RES' . date('Ymd') . rand(1000, 9999);
        
        $result = $db->query("INSERT INTO bookings 
            (booking_reference, user_id, cottage_id, customer_name, customer_email, customer_phone, 
             booking_date, start_time, end_time, total_days, total_amount, special_requests, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, '09:00:00', '18:00:00', ?, ?, ?, 'pending')",
            [$ref, $user['user_id'], $cottage_id, $user['full_name'], $user['email'], $user['phone'],
             $check_in, $days, $total, $special_requests]);
        
        if ($result) {
            return $this->response->setJSON(['success' => true, 'message' => 'Booking created! Reference: ' . $ref]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Booking failed']);
        }
    }
    
    public function myBookings()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $bookings = $db->query("SELECT b.*, c.cottage_name FROM bookings b 
            JOIN cottages c ON b.cottage_id = c.cottage_id 
            WHERE b.user_id = ? ORDER BY b.created_at DESC", [$user_id])->getResultArray();
        
        $data = [
            'title' => 'My Bookings',
            'bookings' => $bookings,
            'isLoggedIn' => true
        ];
        
        return view('customer/my_bookings', $data);
    }
    
    public function cancelBooking($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET status = 'cancelled' WHERE booking_id = ? AND user_id = ?", 
            [$id, session()->get('user_id')]);
        
        session()->setFlashdata('success', 'Booking cancelled');
        return redirect()->to('/my-bookings');
    }
    
    public function myAccount()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        $user = $db->query("SELECT * FROM users WHERE user_id = ?", [$user_id])->getRowArray();
        
        $data = [
            'title' => 'My Account',
            'user' => $user,
            'isLoggedIn' => true
        ];
        
        return view('customer/my_account', $data);
    }
    
    public function updateAccount()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        
        $db->query("UPDATE users SET full_name = ?, email = ?, phone = ? WHERE user_id = ?", 
            [$full_name, $email, $phone, $user_id]);
        
        session()->set('full_name', $full_name);
        session()->setFlashdata('success', 'Account updated successfully!');
        return redirect()->to('/my-account');
    }
    
    public function changePassword()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }
        
        $data = ['title' => 'Change Password', 'isLoggedIn' => true];
        
        return view('customer/change_password', $data);
    }
    
    public function updatePassword()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        if ($new_password != $confirm_password) {
            session()->setFlashdata('error', 'Passwords do not match');
            return redirect()->to('/change-password');
        }
        
        if (strlen($new_password) < 6) {
            session()->setFlashdata('error', 'Password must be at least 6 characters');
            return redirect()->to('/change-password');
        }
        
        $user = $db->query("SELECT * FROM users WHERE user_id = ? AND password = ?", 
            [$user_id, $current_password])->getRowArray();
        
        if (!$user) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to('/change-password');
        }
        
        $db->query("UPDATE users SET password = ? WHERE user_id = ?", [$new_password, $user_id]);
        
        session()->setFlashdata('success', 'Password changed successfully!');
        return redirect()->to('/my-account');
    }
}