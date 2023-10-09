<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryPelatihanController extends Controller
{
    public function index(){
        return view('dashboard.manage-category-pelatihan.category-pelatihan');
    }
}