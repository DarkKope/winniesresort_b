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
                'role' => $user['role'],
                'logged_in' => true
            ]);
            
            return $this->response->setJSON(['success' => true, 'role' => $user['role']]);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Invalid email or password']);
    }
    
    public function ajaxRegister()
    {
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $full_name = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        
        // Check if exists
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