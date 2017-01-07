<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Trainer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $ash = factory(User::class, 'ash')->create();
        $admin = factory(User::class, 'admin')->create();
        $alain = factory(User::class, 'alain')->create();
        Trainer::create(['user_id' => $ash->id]);
        Trainer::create(['user_id' => $alain->id]);
    }
}
