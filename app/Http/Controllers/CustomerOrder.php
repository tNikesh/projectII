<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerOrder extends Controller
{
    public function index(){
        return view('admin.order');
    }
}
