<?php

namespace NanokaWeb\AsyncGame\Seeds\InitialData;

use NanokaWeb\AsyncGame\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::count() == 0) {
            Role::create([
                'id'            => 1,
                'name'          => 'Root',
                'description'   => 'Use this account with extreme caution. When using this account it is possible to cause irreversible damage to the system.'
            ]);

            Role::create([
                'id'            => 2,
                'name'          => 'Administrator',
                'description'   => 'Full access to create, edit, and update.'
            ]);

            Role::create([
                'id'            => 3,
                'name'          => 'User',
                'description'   => 'A standard user that can get and manage his own informations.'
            ]);
        }
    }
}
