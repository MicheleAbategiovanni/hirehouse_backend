<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            "name"=>"required|string|max:255",
            "email"=>"required|email|max:255",
            "content"=>"required|string|max:1000",
            "apartment_id"=>"required|string"
        ]);

        $newMessage = Message::create($data);

        return response()->json($newMessage);
        
    }
} 


