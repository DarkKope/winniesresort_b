<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function ajaxLogin()
    {
        $db = \Config\Database::connect();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $user = $db->query("SELECT * FROM users WHERE email = ?", [$email])->getRowArray();
        
        if ($user && $password == $user['password']) {
            session()->set([
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'full_name' => $user['full_name'],
                'phone' => $user['phone'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            
            // Redirect based on role
            if ($user['role'] == 'admin') {
                return $this->response->setJSON(['success' => true, 'redirect' => '/admin/dashboard']);
            } elseif ($user['role'] == 'staff') {
                return $this->response->setJSON(['success' => true, 'redirect' => '/staff/dashboard']);
            } else {
                return $this->response->setJSON(['success' => true, 'redirect' => '/dashboard']);
            }
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Invalid email or password']);
    }
    
    public function ajaxRegister()
    {
        // Only admin can register new users through admin panel
        // This is for customer registration only
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $full_name = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        
        $check = $db->query("SELECT * FROM users WHERE email = ? OR username = ?", [$email, $username])->getRowArray();
        if ($check) {
            return $this->response->setJSON(['success' => false, 'message' => 'Email or username already exists']);
        }
        
        $db->query("INSERT INTO users (username, email, full_name, phone, password, role) 
                    VALUES (?, ?, ?, ?, ?, 'customer')", 
                    [$username, $email, $full_name, $phone, $password]);
        
        return $this->response->setJSON(['success' => true, 'message' => 'Registration successful! Please login.']);
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}