<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTrainerTest extends TestCase
{
    /** @test */
    public function user_can_login_as_trainer_in_application_using_the_email()
    {
        $user = factory(User::class)->create(['email' => 'ash_champion@test.com', 'password' => '123456']);
        $trainer = Trainer::create(['user_id' => $user->id]);

        $this->call('POST', '/trainers/login', [
            'email'    => 'ash_champion@test.com',
            'password' => '123456',
        ]);

        $this->seePageIs('/trainers/dashboard');
    }
}
