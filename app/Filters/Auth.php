<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }
        
        // Block admin from accessing customer pages
        if (session()->get('role') === 'admin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Admin access only');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}