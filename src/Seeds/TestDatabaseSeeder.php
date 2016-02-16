<?php

namespace NanokaWeb\AsyncGame\Seeds;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use NanokaWeb\AsyncGame\Seeds\TestData\SeedsTableSeeder;
use NanokaWeb\AsyncGame\Seeds\TestData\UsersTableSeeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(SeedsTableSeeder::class);

        Model::reguard();
    }
}
