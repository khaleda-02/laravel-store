<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('test')
        ]);

        // insert a records into a table  , that don't has model in the project 
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test1@example.com',
            'password' => Hash::make('test')
        ]);
    }
}
