<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTrainerTest extends TestCase
{
    /** @test */
    public function user_can_register_as_a_trainer_using_email()
    {
        $this->visit('/trainers/register')
             ->type('Ash', 'name')
             ->type('Ketchum', 'lastname')
             ->type('1995-04-14', 'birthday')
             ->type('KalosChampion', 'username')
             ->press('Register')
             ->seePageIs('/trainers/thanks_for_register');
    }
}
