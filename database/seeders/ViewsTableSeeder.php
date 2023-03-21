<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $apartments=Apartment::all();
        for($i=0;$i<100;$i++){
            $view=new View();
            $view->date=$faker->date();
            $view->indirizzo_ip=$faker->ipv4();
            // dd($apartments->random(1,true)->pluck("id"));
            $view->apartment_id=rand(1,$apartments->count());
            $view->save();

        }

    }
}
