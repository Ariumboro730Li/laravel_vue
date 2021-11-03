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
        $faker = Faker::create("id_ID");
        for ($i=0; $i < 100000 ; $i++) {
            $data[] = [
                "name" => $faker->unique()->name,
                "profession" => $faker->jobTitle,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }

        foreach (array_chunk($data, 10000) as $key => $insert) {
            TestApi::insert($insert);
        }
    }
}
