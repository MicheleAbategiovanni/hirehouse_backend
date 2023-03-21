<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                "name"=>"Wi-fi",
                "icon"=>"fa-wifi"
            ],
            [
                "name"=>"Cucina",
                "icon"=>"fa-kitchen-set"
            ],
            [
                "name"=>"Doccia",
                "icon"=>"fa-shower"
            ],
            [
                "name"=>"Vasca",
                "icon"=>"fa-bath"
            ],
            [
                "name"=>"Riscaldamento",
                "icon"=>"fa-fire"
            ],
            [
                "name"=>"Climatizzatore",
                "icon"=>"fa-snowflake"
            ],
            [
                "name"=>"Lavatrice",
                "icon"=>"fa-jug-detergent"
            ],
            [
                "name"=>"Parcheggio",
                "icon"=>"fa-square-parking"
            ],
            [
                "name"=>"Piscina",
                "icon"=>"fa-person-swimming"
            ],
            [
                "name"=>"Check-in automatico",
                "icon"=>"fa-key"
            ],
            [
                "name"=>"Check-out automatico",
                "icon"=>"fa-arrow-right-from-bracket"
            ],
            [
                "name"=>"Estintore",
                "icon"=>"fa-fire-extinguisher"
            ],


        ];
        foreach($data as $dato){
            $service=new Service();
            $service->name=$dato["name"];
            $service->icon=$dato["icon"];
            $service->save();
        }
    }
}
