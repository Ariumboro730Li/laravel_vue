<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Search;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SearchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Search::truncate();
        $faker = Faker::create("id_ID");
        for ($i=0; $i < 100000 ; $i++) {
            $data[] = [
                'value' => $faker->unique()->name,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }
        foreach (array_chunk($data, 10000) as $key => $insert) {
            Search::insert($insert);
        }
    }
}
