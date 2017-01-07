<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Trainer;
use App\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainers')->delete();
        DB::table('admins')->delete();
        DB::table('users')->delete();

        $ash = factory(User::class, 'ash')->create();
        $admin = factory(User::class, 'admin')->create();
        $alain = factory(User::class, 'alain')->create();

        Trainer::create(['user_id' => $ash->id]);
        Trainer::create(['user_id' => $alain->id]);
        Admin::create(['user_id' => $admin->id]);
    }
}
