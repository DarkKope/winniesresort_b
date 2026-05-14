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
        return view('auth/customer_login');
    }
    
    public function doLogin()
    {
        $db = \Config\Database::connect();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Find user by email
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
        return view('auth/customer_register');
    }
    
    public function doRegister()
    {
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $full_name = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        
        // Validation
        $errors = [];
        
        if (empty($username)) $errors[] = 'Username is required';
        if (empty($email)) $errors[] = 'Email is required';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';
        if (empty($full_name)) $errors[] = 'Full name is required';
        if (empty($phone)) $errors[] = 'Phone number is required';
        if (empty($password)) $errors[] = 'Password is required';
        if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters';
        
        // Check if user exists
        $checkEmail = $db->query("SELECT * FROM users WHERE email = ?", [$email])->getRowArray();
        if ($checkEmail) $errors[] = 'Email already registered';
        
        $checkUser = $db->query("SELECT * FROM users WHERE username = ?", [$username])->getRowArray();
        if ($checkUser) $errors[] = 'Username already taken';
        
        if (!empty($errors)) {
            session()->setFlashdata('error', implode('<br>', $errors));
            return redirect()->to('/register');
        }
        
        // Insert new customer
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