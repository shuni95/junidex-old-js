<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Carbon\Carbon;

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
        $this->call('POST', '/trainers/register', ['lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'email' => 'ash_champion@test.com', 'password' => '123456', 'confirm_password' => '123456']);

        $this->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function user_cannot_register_without_fields()
    {
        $this->call('POST', '/trainers/register', []);

        $this->assertSessionHasErrors(['name', 'lastname', 'birthday', 'username', 'email', 'password']);
    }

    /** @test */
    public function user_only_register_a_username_with_only_letters_and_numbers()
    {
        $user = ['name' => 'ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'email' => 'ash_champion@test.com', 'password' => '123456', 'confirm_password' => '123456'];

        $this->call('POST', '/trainers/register', array_merge($user, ['username' => 'Kalos Champion']));

        $this->assertSessionHasErrors(['username']);

        $this->call('POST', '/trainers/register', array_merge($user, ['username' => 'Kalos-Champion']));

        $this->assertSessionHasErrors(['username']);

        $this->call('POST', '/trainers/register', array_merge($user, ['username' => 'Kalos-Champion123']));

        $this->assertSessionHasErrors(['username']);

        $this->call('POST', '/trainers/register', array_merge($user, ['username' => 'KalosChampion123']));
        $this->followRedirects();
        $this->seePageIs('/trainers/thanks_for_register');
    }

    /** @test */
    public function user_only_register_if_age_is_greater_than_ten()
    {
        $user = ['name' => 'ash', 'lastname' => 'Ketchum', 'email' => 'ash_champion@test.com', 'username' => 'Kalos Champion', 'password' => '123456', 'confirm_password' => '123456'];

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::today()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::yesterday()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::now()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::subYears(5)]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::subYears(9)]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::subYears(10)]));
        $this->followRedirects();
        $this->seePageIs('/trainers/thanks_for_register');
    }
}
