<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;



    // un servizio può essere incluso in più appartementi 
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }

    
}
