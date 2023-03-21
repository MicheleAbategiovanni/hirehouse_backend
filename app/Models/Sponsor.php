<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    // uno sponsor può essere incluso in più appartementi 
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
