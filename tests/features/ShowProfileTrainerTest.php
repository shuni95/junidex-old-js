<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowProfileTrainerTest extends TestCase
{
    /** @test */
    public function trainer_can_see_his_own_profile()
    {
        $user = factory(User::class)->create(['name' => 'Ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'email' => 'ash_champion@test.com']);
        Trainer::create(['user_id' => $user->id]);

        $this->actingAs($user);

        $this->visit('/trainers/me')
             ->see('Ash')
             ->see('Ketchum')
             ->see('14/04/1995')
             ->see('KalosChampion')
             ->see('ash_champion@test.com');
    }
}
