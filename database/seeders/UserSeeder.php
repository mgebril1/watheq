<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        	'name' => 'Mahmoud Gebril',
        	'username' => 'user',
        	'password' => 'password', // There is mutator in model that has it
        	'type'	   => 'normal',
        	'is_active'	=> 1,
        ]);
    }
}
