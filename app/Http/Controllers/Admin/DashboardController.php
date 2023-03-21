<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home(){
        
        $apartments = Apartment::where('user_id', Auth::user()->id)->get();


        return view("admin.dashboard",compact("apartments"));
    }
}
