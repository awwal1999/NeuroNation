<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        Session::factory(20)->create([
             'user_id' => $user->id,
        ]);
    }
}
