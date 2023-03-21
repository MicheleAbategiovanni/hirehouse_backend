<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(Faker $faker){
        for($i=0;$i<15;$i++){
            $user=new User();
            $user->name=$faker->firstName();
            $user->email=$faker->email();
            $user->surname=$faker->lastName();
            $user->date_of_birth=$faker->date();
            $user->password="$2y$10$.mwzIaNj3.UTfkVjPCq0euGYZGxYx8ZFPthRN8fYsp8t3ioXcOi6K";
            $user->save();

        }

    }
}
