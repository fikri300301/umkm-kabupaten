<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index(){
        return view('dashboard.manage-bidang.bidang');
    }
}