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

        $ash = factory(User::class, 'ash')->create(['id' => 1]);
        $admin = factory(User::class, 'admin')->create(['id' => 2]);
        $alain = factory(User::class, 'alain')->create(['id' => 3]);

        Trainer::create(['user_id' => $ash->id]);
        Trainer::create(['user_id' => $alain->id]);
        Admin::create(['user_id' => $admin->id]);
    }
}
