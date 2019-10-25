<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersTableSeeder::class);

        $this->runUsers();
    }

    public function runUsers()
    {
        DB::table('users')->delete();

        User::create(['id' => 1, 'name' => 'Muzmatch', 'email' => 'test@muzmatch.com', 'email_verified_at' => NULL,
            'password' => '$2y$10$apHnmPm9GltYK4pNSZNSfuQrSAId6Ft0WUXHDL7G33lZ8I72pAIKq', 'remember_token' => '',
            'created_at' => '2019-10-16 18:58:32', 'updated_at' => '2019-10-16 18:58:32']);
    }
}

