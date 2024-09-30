<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(){
        $admin = auth()->user(); // Or
            $users = User::all(); // Or however you want to fetch your users
            return view('admin.dashboard', compact('users'));
       
    }
}
