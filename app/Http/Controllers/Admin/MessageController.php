<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Apartment $apartment)
    {
        if($apartment->user_id!==Auth::id()){
            abort(403,"Non sei autorizzato a visualizzare questi messaggi");
        };
        $messages = $apartment->messages;

        return view("admin.messages.index",compact("messages","apartment"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        
        $message->delete();
        
        return redirect()->route("admin.messages.index",$message->apartment->id);
    }
}
