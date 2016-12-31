<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTrainerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_register_as_a_trainer_using_email()
    {
        $this->visit('/trainers/register')
             ->type('Ash', 'name')
             ->type('Ketchum', 'lastname')
             ->type('1995-04-14', 'birthday')
             ->type('KalosChampion', 'username')
             ->type('ash_champion@test.com', 'email')
             ->type('123456', 'password')
             ->type('123456', 'confirm_password')
             ->press('Register')
             ->seePageIs('/trainers/thanks_for_register');
    }

    /** @test */
    public function user_cannot_see_thanks_for_register_directly()
    {
        $this->visit('/trainers/thanks_for_register');

        $this->seePageIs('/trainers/register');
    }

    /** @test */
    public function user_cannot_register_without_name_field()
    {
        $this->visit('/trainers/register')
             ->type('Ketchum', 'lastname')
             ->type('1995-04-14', 'birthday')
             ->type('KalosChampion', 'username')
             ->type('ash_champion@test.com', 'email')
             ->type('123456', 'password')
             ->type('123456', 'confirm_password')
             ->press('Register')
             ->seePageIs('/trainers/register');
    }
}
