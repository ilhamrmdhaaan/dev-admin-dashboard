<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Faker::create('id_ID');


        /**SUPER ADMIN */
        $users = [
            ['Admin', 'admin', 'admin@mail.com'],
        ];

        foreach ($users as $user) {
            $user = User::create([
                'name' => $user[0],
                'username' => $user[1],
                'email' => $user[2],
                'password' => bcrypt('admin')
            ]);
            $role = 'super_admin';
            $permission = ['create', 'read', 'update', 'delete'];
            $user->assignRole([$role]);
            $user->givePermissionTo([$permission]);
            $role = Role::find(1);
            $role->givePermissionTo([$permission]);
        }

            /** USER **/
            $users = [
                ['UserTesting', 'user', 'user@mail.com'],
            ];
    
            foreach ($users as $user) {
                $user = User::create([
                    'name' => $user[0],
                    'username' => $user[1],
                    'email' => $user[2],
                    'password' => bcrypt('admin')
                ]);
                $role = 'user';
                $permission = ['create', 'read', 'update', 'delete'];
                $user->assignRole([$role]);
                $user->givePermissionTo([$permission]);
                $role = Role::find(2);
                $role->givePermissionTo([$permission]);
            }
    }
}
