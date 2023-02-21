<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $test =
        [
            [
                'name' => 'Admin Test',
                'email' => 'admin@test.com',
                'phone' => '0000000000000',
                'password' => Hash::make('test'),
                'role' => 'admin'
            ],
            [
              'name' => 'User',
              'email' => 'user@test.com',
              'phone' => '0000000000000',
              'password' => Hash::make('test'),
              'role' => 'user' 
            ],
            [
            'name' => 'Super Admin',
            'email' => 'superadmin@knightstore.com',
            'phone' => '0000000000000',
            'password' => Hash::make('knightstore12345'),
            'role' => 'superadmin'
            ]
            ];
            
            foreach ($test as $item) {
                DB::table('users')->insert([
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'phone' => $item['phone'],
                    'password' => $item['password'],
                    'role' => $item['role']
                ]);
            }
    }
}
