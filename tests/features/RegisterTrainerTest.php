<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTrainerTest extends TestCase
{
    use WithoutMiddleware;
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
    public function user_cannot_register_without_name()
    {
        $this->call('POST', '/trainers/register', [
            'lastname' => 'Ketchum',
            'birthday' => '1995-04-14',
            'username' => 'KalosChampion',
            'email' => 'ash_champion@test.com',
            'password' => '123456',
            'confirm_password' => '123456',
        ]);

        $this->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function user_cannot_register_without_fields()
    {
        $this->call('POST', '/trainers/register', []);

        $this->assertSessionHasErrors(['name', 'lastname', 'birthday', 'username', 'email', 'password']);
    }
}
