<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [ "name","email", "content", "apartment_id"];

    // un messaggio avrà come riferimento un solo appartamento
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
