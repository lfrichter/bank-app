<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@bnb.com',
            'password' => Hash::make('12345678'),
        ];

        $admin = Admin::firstOrCreate($admin);

        if($admin->wasRecentlyCreated){
            echo 'Admin was created' . PHP_EOL;
        }
    }
}
