<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Andrean Ramadani', 'email' => 'akunandrea@gmail.com', 'password' => Hash::make('akunandre'), 'role' => 'admin']);
        User::create(['name' => 'Micko Samawa', 'email' => 'akunmicko@gmail.com', 'password' => Hash::make('akunmicko'), 'role' => 'admin']);
        User::create(['name' => 'Reyhan Iqbal', 'email' => 'akuniqbal@gmail.com', 'password' => Hash::make('akuniqbal'), 'role' => 'admin']);
        User::create(['name' => 'Retasya Salsabila', 'email' => 'akunchaca@gmail.com', 'password' => Hash::make('akunchaca'), 'role' => 'admin']);
        User::create(['name' => 'Alya Ghania', 'email' => 'akunalya@gmail.com', 'password' => Hash::make('akunalya'), 'role' => 'admin']);
        User::create(['name' => 'Micko Samawa', 'email' => 'budi@example.com', 'password' => Hash::make('password'), 'role' => 'masyarakat']);
        User::create(['name' => 'Reyhan Iqbal', 'email' => 'joko@example.com', 'password' => Hash::make('password'), 'role' => 'sopir']);
    }
}
