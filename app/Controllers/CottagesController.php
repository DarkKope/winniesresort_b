<?php

namespace App\Controllers;

use App\Models\CottageModel;

class CottagesController extends BaseController
{
    public function index()
    {
        $model = new CottageModel();
        $data['cottages'] = $model->where('status', 'available')->findAll();
        $data['title'] = 'Our Cottages';
        
        return view('cottages/index', $data);
    }
    
    public function view($id)
    {
        $model = new CottageModel();
        $data['cottage'] = $model->find($id);
        
        if (!$data['cottage']) {
            return redirect()->to('/cottages')->with('error', 'Cottage not found');
        }
        
        $data['title'] = $data['cottage']['name'];
        
        return view('cottages/view', $data);
    }
}