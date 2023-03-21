<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

     // unA Rule può essere inclusa in più appartementi 
     public function apartments()
     {
         return $this->belongsToMany(Apartment::class);
     }
}
