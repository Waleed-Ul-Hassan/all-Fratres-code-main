<?php

use App\Seeker;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeekerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for($k=0; $k<=13; $k++) {
            $faker = Factory::create();
            $username = str_replace(" ", "", $faker->name);
            $username = str_replace(".", "", $username);
            $username = str_replace(".", "", $username);
            $username = strtolower($username);

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('seekers')->insert([
                'username' => $username,
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => Str::random(10)
            ]);

            $id = DB::getPdo()->lastInsertId();
            for ($i = 0; $i <= rand(5,10); $i++) {
                DB::table('seeker_skill')->insert([
                    'seeker_id' => $id,
                    'skill_id' => rand(1, 600)
                ]);

            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }


    }
}
