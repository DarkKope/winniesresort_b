<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\CottageModel;

class BookingsController extends BaseController
{
    public function create($cottage_id)
    {
        $cottageModel = new CottageModel();
        $data['cottage'] = $cottageModel->find($cottage_id);
        
        if (!$data['cottage']) {
            return redirect()->to('/cottages')->with('error', 'Cottage not found');
        }
        
        $data['title'] = 'Book ' . $data['cottage']['name'];
        
        return view('bookings/create', $data);
    }
    
    public function store()
    {
        $model = new BookingModel();
        
        $checkIn = $this->request->getPost('check_in');
        $checkOut = $this->request->getPost('check_out');
        
        // Calculate nights
        $datetime1 = new \DateTime($checkIn);
        $datetime2 = new \DateTime($checkOut);
        $nights = $datetime1->diff($datetime2)->days;
        
        $cottageModel = new CottageModel();
        $cottage = $cottageModel->find($this->request->getPost('cottage_id'));
        
        $totalAmount = $nights * $cottage['price'];
        
        $data = [
            'user_id' => session()->get('id'),
            'cottage_id' => $this->request->getPost('cottage_id'),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $this->request->getPost('guests'),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'special_requests' => $this->request->getPost('special_requests'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($model->insert($data)) {
            return redirect()->to('/my-bookings')->with('success', 'Booking submitted successfully! Awaiting confirmation.');
        } else {
            return redirect()->back()->with('errors', $model->errors());
        }
    }
    
    public function myBookings()
    {
        $model = new BookingModel();
        $data['bookings'] = $model->select('bookings.*, cottages.name as cottage_name, cottages.image')
            ->join('cottages', 'cottages.id = bookings.cottage_id')
            ->where('user_id', session()->get('id'))
            ->orderBy('id', 'DESC')
            ->findAll();
        
        return view('bookings/my_bookings', $data);
    }
    
    public function detail($id)
    {
        $model = new BookingModel();
        $data['booking'] = $model->select('bookings.*, cottages.name as cottage_name, cottages.price, cottages.image')
            ->join('cottages', 'cottages.id = bookings.cottage_id')
            ->where('bookings.id', $id)
            ->where('user_id', session()->get('id'))
            ->first();
        
        if (!$data['booking']) {
            return redirect()->to('/my-bookings')->with('error', 'Booking not found');
        }
        
        return view('bookings/detail', $data);
    }
}