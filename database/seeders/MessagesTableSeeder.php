<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {

        for($i=0;$i<10;$i++){
            $message=new Message();
            $message->content=$faker->text(200);
            $message->email=$faker->email();
            $message->name=$faker->name();
            $message->apartment_id=rand(1,15);
            $message->save();

        }
        
    }
}
