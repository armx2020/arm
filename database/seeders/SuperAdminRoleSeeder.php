<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'super-admin']);

        $user1 = User::find(1);
        $user1->assignRole('super-admin');

        $user2= User::find(2);
        $user2->assignRole('super-admin');

        $user3 = User::find(3);
        $user3->assignRole('super-admin');
    }
}
