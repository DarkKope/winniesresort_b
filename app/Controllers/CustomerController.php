<?php

namespace App\Controllers;

use App\Models\CottageModel;
use App\Models\BookingModel;
use App\Models\UserModel;

class Customer extends BaseController
{
    public function dashboard()
    {
        $bookingModel = new BookingModel();
        $data = [
            'total_bookings' => $bookingModel->where('user_id', session()->get('user_id'))->countAllResults(),
            'pending' => $bookingModel->where('user_id', session()->get('user_id'))->where('status', 'pending')->countAllResults(),
            'approved' => $bookingModel->where('user_id', session()->get('user_id'))->where('status', 'approved')->countAllResults(),
            'recent_bookings' => $bookingModel->where('user_id', session()->get('user_id'))->orderBy('id', 'DESC')->findAll(5)
        ];
        return view('customer/dashboard', $data);
    }
    
    public function cottages()
    {
        $model = new CottageModel();
        $data['cottages'] = $model->findAll();
        return view('customer/cottages', $data);
    }
    
    public function cottageDetail($id)
    {
        $model = new CottageModel();
        $data['cottage'] = $model->find($id);
        return view('customer/cottage_detail', $data);
    }
    
    public function bookingForm($cottage_id)
    {
        $cottageModel = new CottageModel();
        $data['cottage'] = $cottageModel->find($cottage_id);
        return view('customer/booking_form', $data);
    }
    
    public function submitBooking()
    {
        $model = new BookingModel();
        
        $checkIn = $this->request->getPost('check_in');
        $checkOut = $this->request->getPost('check_out');
        
        $days = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
        
        $cottageModel = new CottageModel();
        $cottage = $cottageModel->find($this->request->getPost('cottage_id'));
        
        $total = $days * $cottage['price'];
        
        $data = [
            'user_id'    => session()->get('user_id'),
            'cottage_id' => $this->request->getPost('cottage_id'),
            'check_in'   => $checkIn,
            'check_out'  => $checkOut,
            'guests'     => $this->request->getPost('guests'),
            'total'      => $total,
            'status'     => 'pending'
        ];
        
        $model->insert($data);
        return redirect()->to('/my-bookings')->with('success', 'Booking submitted successfully');
    }
    
    public function myBookings()
    {
        $model = new BookingModel();
        $data['bookings'] = $model->select('bookings.*, cottages.name as cottage_name')
            ->join('cottages', 'cottages.id = bookings.cottage_id')
            ->where('user_id', session()->get('user_id'))
            ->orderBy('id', 'DESC')
            ->findAll();
        return view('customer/my_bookings', $data);
    }
    
    public function profile()
    {
        $model = new UserModel();
        $data['user'] = $model->find(session()->get('user_id'));
        return view('customer/profile', $data);
    }
    
    public function updateProfile()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email')
        ];
        $model->update(session()->get('user_id'), $data);
        return redirect()->back()->with('success', 'Profile updated');
    }
}