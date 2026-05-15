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
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $cottages = $db->query("SELECT * FROM cottages ORDER BY cottage_id DESC")->getResultArray();
        return view('admin/cottages', ['cottages' => $cottages]);
    }
    
    public function addCottage()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        return view('admin/add_cottage');
    }
    
    public function saveCottage()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        
        // Handle image upload
        $image_url = null;
        $file = $this->request->getFile('cottage_image');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Create uploads directory if not exists
            $uploadPath = WRITEPATH . 'uploads/cottages/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Generate unique filename
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $image_url = base_url('writable/uploads/cottages/' . $newName);
        } else {
            // If no file uploaded, use the provided URL
            $image_url = $this->request->getPost('image_url');
        }
        
        $db->query("INSERT INTO cottages (cottage_name, description, price_per_day, capacity, status, image_url) 
                    VALUES (?, ?, ?, ?, ?, ?)",
                    [$this->request->getPost('cottage_name'), 
                     $this->request->getPost('description'),
                     $this->request->getPost('price_per_day'), 
                     $this->request->getPost('capacity'),
                     $this->request->getPost('status'),
                     $image_url]);
        
        session()->setFlashdata('success', 'Cottage added successfully');
        return redirect()->to('/admin/cottages');
    }
    
    public function editCottage($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $cottage = $db->query("SELECT * FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        return view('admin/edit_cottage', ['cottage' => $cottage]);
    }
    
    public function updateCottage($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        
        // Get current cottage to check existing image
        $current = $db->query("SELECT image_url FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        $image_url = $current['image_url'];
        
        // Handle image upload
        $file = $this->request->getFile('cottage_image');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Create uploads directory if not exists
            $uploadPath = WRITEPATH . 'uploads/cottages/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Delete old image if exists
            if ($image_url && file_exists(WRITEPATH . 'uploads/cottages/' . basename($image_url))) {
                unlink(WRITEPATH . 'uploads/cottages/' . basename($image_url));
            }
            
            // Upload new image
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $image_url = base_url('writable/uploads/cottages/' . $newName);
        } else {
            // Use URL input if provided
            $url_image = $this->request->getPost('image_url');
            if (!empty($url_image)) {
                $image_url = $url_image;
            }
        }
        
        $db->query("UPDATE cottages SET cottage_name=?, description=?, price_per_day=?, capacity=?, status=?, image_url=? WHERE cottage_id=?",
                    [$this->request->getPost('cottage_name'), 
                     $this->request->getPost('description'),
                     $this->request->getPost('price_per_day'), 
                     $this->request->getPost('capacity'),
                     $this->request->getPost('status'),
                     $image_url, $id]);
        
        session()->setFlashdata('success', 'Cottage updated successfully');
        return redirect()->to('/admin/cottages');
    }
    
    public function deleteCottage($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        
        // Get image to delete
        $cottage = $db->query("SELECT image_url FROM cottages WHERE cottage_id = ?", [$id])->getRowArray();
        if ($cottage && $cottage['image_url']) {
            $imagePath = WRITEPATH . 'uploads/cottages/' . basename($cottage['image_url']);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
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
        
        return view('admin/bookings', ['bookings' => $bookings]);
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
        
        return view('admin/view_booking', ['booking' => $booking]);
    }
    
    public function updateBookingStatus()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET status = ? WHERE booking_id = ?",
                    [$this->request->getPost('status'), $this->request->getPost('booking_id')]);
        
        session()->setFlashdata('success', 'Status updated');
        return redirect()->to('/admin/bookings');
    }
    
    public function verifyPayment($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $db->query("UPDATE bookings SET payment_status = 'paid', payment_date = NOW() WHERE booking_id = ?", [$id]);
        
        session()->setFlashdata('success', 'Payment verified successfully!');
        return redirect()->to('/admin/bookings');
    }
    
    public function users()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) return $redirect;
        
        $db = \Config\Database::connect();
        $users = $db->query("SELECT * FROM users ORDER BY user_id DESC")->getResultArray();
        return view('admin/users', ['users' => $users]);
    }
}