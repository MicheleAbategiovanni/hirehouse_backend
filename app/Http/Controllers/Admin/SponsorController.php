<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Apartment $apartment)
    {
        if($apartment->user_id!==Auth::id()){
            abort(403,"Non sei autorizzato a visualizzare questi messaggi");
        };
        $sponsors =Sponsor::all();

        return view("admin.sponsors.index",compact("sponsors", "apartment"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    
    

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
