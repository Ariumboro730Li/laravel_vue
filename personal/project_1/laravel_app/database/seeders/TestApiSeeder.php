<?php

namespace Database\Seeders;

use App\Models\TestApi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TestApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestApi::truncate();

        $faker = Faker::create('id_ID');
        for ($a=0; $a < 100000 ; $a++) {
            $data = [];
            for ($i=0; $i < 100 ; $i++) {
                $data[] = [
                    "name" => $faker->unique()->name,
                    "profession" => $faker->jobTitle,
                    "company" => $faker->company,
                    "salary" => rand(1000000,1000000000),
                    "address" => $faker->address,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ];
            }
            foreach (array_chunk($data, 100) as $key => $insert) {
                TestApi::insert($insert);
            }
        }
    }
}
