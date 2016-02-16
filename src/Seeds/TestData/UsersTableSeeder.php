<?php

namespace NanokaWeb\AsyncGame\Seeds\TestData;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 150)->create()->each(function ($u) {

        });
    }
}