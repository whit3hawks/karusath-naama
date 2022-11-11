<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'author']);
        $user = User::create([
            'name' => "Admin",
            'email' => "whit3hawks@gmail.com",
            'password' => bcrypt('2vOPm8Qx45'),
        ]);
        $user = User::where('email', 'whit3hawks@gmail.com')->first();
        $user->assignRole('admin');
    }
}
