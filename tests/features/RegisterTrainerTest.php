<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Carbon\Carbon;
use App\User;

class RegisterTrainerTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

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
        $user = ['name' => 'ash', 'lastname' => 'Ketchum', 'email' => 'ash_champion@test.com', 'username' => 'KalosChampion', 'password' => '123456', 'confirm_password' => '123456'];

        $today = Carbon::today();

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => $today->copy()->toDateString()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => $today->copy()->subDay()->toDateString()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => Carbon::now()->toDateString()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => $today->copy()->subYears(5)->toDateString()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => $today->copy()->subYears(9)->toDateString()]));

        $this->assertSessionHasErrors(['birthday']);

        $this->call('POST', '/trainers/register', array_merge($user, ['birthday' => $today->copy()->subYears(10)->toDateString()]));
        $this->followRedirects();
        $this->seePageIs('/trainers/thanks_for_register');
    }

    /** @test */
    public function user_only_can_register_with_valid_email()
    {
        $user = ['name' => 'ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'password' => '123456', 'confirm_password' => '123456'];

        $this->call('POST', '/trainers/register', array_merge($user, ['email' => 'test']));

        $this->assertSessionHasErrors(['email']);

        $this->call('POST', '/trainers/register', array_merge($user, ['email' => 'test()@test.com']));

        $this->assertSessionHasErrors(['email']);

        $this->call('POST', '/trainers/register', array_merge($user, ['email' => 'test@test.com']));
        $this->followRedirects();
        $this->seePageIs('/trainers/thanks_for_register');
    }

    /** @test */
    public function user_can_see_error_messages_when_first_name_and_lastname_is_blank()
    {
        $this->visit('/trainers/register')
             ->type('1995-04-14', 'birthday')
             ->type('KalosChampion', 'username')
             ->type('ash_champion@test.com', 'email')
             ->type('123456', 'password')
             ->type('123456', 'confirm_password')
             ->press('Register')
             ->see('The trainer\'s first name is required.')
             ->see('The trainer\'s last name is required.');
    }

    /** @test */
    public function user_cannot_register_when_username_or_email_already_exists()
    {
        factory(User::class, 'default')->create(['username' => 'Pikachu123', 'email' => 'abc@test.com']);

        $this->visit('/trainers/register')
             ->type('test', 'name')
             ->type('test', 'lastname')
             ->type('1995-04-14', 'birthday')
             ->type('Pikachu123', 'username')
             ->type('abc@test.com', 'email')
             ->type('123456', 'password')
             ->type('123456', 'confirm_password')
             ->press('Register');

        $this->see('The username has already exists');
        $this->see('The email has already exists');
    }

}
