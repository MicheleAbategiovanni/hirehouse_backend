<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                "name"=>"Animali ammessi",
                "icon"=>"fa-dog"
            ],
            [
                "name"=>"Animali proibiti",
                "icon"=>"fa-x"
            ],
            [
                "name"=>"Vietato fumare",
                "icon"=>"fa-ban-smoking"
            ],
            [
                "name"=>"No party",
                "icon"=>"fa-ban"
            ],
            [
                "name"=>"Consentito fumare",
                "icon"=>"fa-smoking"
            ],
            [
                "name"=>"Orario di silenzio (22:00/9:00)",
                "icon"=>"fa-volume-xmark"
            ],
            [
                "name"=>"No bambini",
                "icon"=>"fa-user-slash"
            ],
          
           


        ];
        foreach($data as $dato){
            $rule=new Rule();
            $rule->name=$dato["name"];
            $rule->icon=$dato["icon"];
            $rule->save();
        }
    }
    }
