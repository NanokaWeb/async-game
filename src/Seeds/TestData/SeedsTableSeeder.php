<?php

namespace NanokaWeb\AsyncGame\Seeds\TestData;

use NanokaWeb\AsyncGame\Seed;
use Illuminate\Database\Seeder;

class SeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i > 20; $i++)
            Seed::create([
                'id' => $i,
            ]);
    }
}
