<?php

namespace NanokaWeb\AsyncGame\Seeds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use NanokaWeb\AsyncGame\Seeds\InitialData\RolesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);

        Model::reguard();
    }
}
