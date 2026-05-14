<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages WHERE status = 'available' ORDER BY price_per_day ASC")->getResultArray();
        
        $data = [
            'title' => 'Winnie\'s Resort',
            'cottages' => $cottages,
            'isLoggedIn' => session()->get('logged_in') ? true : false
        ];
        
        return view('customer/dashboard_main', $data);
    }
    
    public function myAccount()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        // Get user data
        $query = $db->query("SELECT * FROM users WHERE user_id = ?", [$user_id]);
        $user = $query->getRowArray();
        
        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }
        
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
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        
        // Validate
        if (empty($full_name) || empty($email) || empty($phone)) {
            session()->setFlashdata('error', 'All fields are required');
            return redirect()->to('/my-account');
        }
        
        // Check if email exists for another user
        $check = $db->query("SELECT * FROM users WHERE email = ? AND user_id != ?", [$email, $user_id])->getRowArray();
        if ($check) {
            session()->setFlashdata('error', 'Email already used by another account');
            return redirect()->to('/my-account');
        }
        
        // Update user
        $db->query("UPDATE users SET full_name = ?, email = ?, phone = ? WHERE user_id = ?", 
            [$full_name, $email, $phone, $user_id]);
        
        // Update session
        session()->set('full_name', $full_name);
        session()->set('email', $email);
        session()->setFlashdata('success', 'Account updated successfully!');
        
        return redirect()->to('/my-account');
    }
    
    public function changePassword()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Change Password',
            'isLoggedIn' => true
        ];
        
        return view('customer/change_password', $data);
    }
    
    public function updatePassword()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $user_id = session()->get('user_id');
        
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        // Validate
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            session()->setFlashdata('error', 'All fields are required');
            return redirect()->to('/change-password');
        }
        
        if ($new_password != $confirm_password) {
            session()->setFlashdata('error', 'New passwords do not match');
            return redirect()->to('/change-password');
        }
        
        if (strlen($new_password) < 6) {
            session()->setFlashdata('error', 'Password must be at least 6 characters');
            return redirect()->to('/change-password');
        }
        
        // Verify current password
        $user = $db->query("SELECT * FROM users WHERE user_id = ? AND password = ?", 
            [$user_id, $current_password])->getRowArray();
        
        if (!$user) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to('/change-password');
        }
        
        // Update password
        $db->query("UPDATE users SET password = ? WHERE user_id = ?", [$new_password, $user_id]);
        
        session()->setFlashdata('success', 'Password changed successfully!');
        return redirect()->to('/my-account');
    }
    
    public function createBooking($cottage_id)
    {
        if (!session()->get('logged_in')) {
            session()->set('redirect_after_login', '/book/' . $cottage_id);
            return redirect()->to('/login')->with('error', 'Please login to make a booking');
        }
        
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$cottage_id])->getRowArray();
        
        $data = [
            'title' => 'Book Now',
            'cottage' => $cottage,
            'isLoggedIn' => true
        ];
        
        return view('customer/book', $data);
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
    $payment_method = $this->request->getPost('payment_method');
    $gcash_reference = $this->request->getPost('gcash_reference') ?? '';
    
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
    $payment_status = ($payment_method == 'cash') ? 'pending' : 'pending';
    
    $db->query("INSERT INTO bookings 
        (booking_reference, user_id, cottage_id, customer_name, customer_email, customer_phone, 
         booking_date, start_time, end_time, total_days, total_amount, special_requests, 
         status, payment_method, payment_reference, payment_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, '09:00:00', '18:00:00', ?, ?, ?, 'pending', ?, ?, ?)",
        [$ref, $user['user_id'], $cottage_id, $user['full_name'], $user['email'], $user['phone'],
         $check_in, $days, $total, $special_requests, $payment_method, $gcash_reference, $payment_status]);
    
    return $this->response->setJSON(['success' => true, 'message' => 'Booking created! Reference: ' . $ref]);
}
    
    public function myBookings()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
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
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET status = 'cancelled' WHERE booking_id = ? AND user_id = ?", 
            [$id, session()->get('user_id')]);
        
        session()->setFlashdata('success', 'Booking cancelled');
        return redirect()->to('/my-bookings');
    }
}