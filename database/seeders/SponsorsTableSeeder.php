<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        $dati=[
            [
                "name"=>"boost",
                "hours"=>24,
                "price"=>2.99,
            ],
            [
                "name"=>"superboost",
                "hours"=>72,
                "price"=>5.99
            ],
            [
                "name"=>"ultraboost",
                "hours"=>144,
                "price"=>9.99
            ],
        ];
        foreach($dati as $dato){
            $sponsor=new Sponsor();
            $sponsor->price=$dato["price"];
            $sponsor->hours=$dato["hours"];
            $sponsor->name=$dato["name"];
            $sponsor->save();
    
        }
        

    }

    
}