<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            if (session()->get('role') == 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }
    
    public function doLogin()
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
            
            if ($user['role'] == 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/dashboard');
            }
        }
        
        session()->setFlashdata('error', 'Invalid email or password');
        return redirect()->to('/login');
    }
    
    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }
    
    public function doRegister()
    {
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $full_name = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        
        if (empty($username) || empty($email) || empty($full_name) || empty($phone) || empty($password)) {
            session()->setFlashdata('error', 'All fields are required');
            return redirect()->to('/register');
        }
        
        if (strlen($password) < 6) {
            session()->setFlashdata('error', 'Password must be at least 6 characters');
            return redirect()->to('/register');
        }
        
        $check = $db->query("SELECT * FROM users WHERE email = ? OR username = ?", [$email, $username])->getRowArray();
        if ($check) {
            session()->setFlashdata('error', 'Email or username already exists');
            return redirect()->to('/register');
        }
        
        $db->query("INSERT INTO users (username, email, full_name, phone, password, role) 
                    VALUES (?, ?, ?, ?, ?, 'customer')", 
                    [$username, $email, $full_name, $phone, $password]);
        
        session()->setFlashdata('success', 'Registration successful! Please login.');
        return redirect()->to('/login');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}