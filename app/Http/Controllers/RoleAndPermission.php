<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

class RoleAndPermission extends Controller
{
    public function indexRole(){
        return view('dashboard.manage-role-and-permission.role');
    }
    public function indexPermission(){
        return view('dashboard.manage-role-and-permission.permission');
    }
}