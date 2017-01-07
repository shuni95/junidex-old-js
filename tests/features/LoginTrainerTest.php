<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;

class LoginTrainerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_login_as_trainer_in_application_using_the_email()
    {
        $this->call('POST', '/trainers/login', [
            'email'    => 'ash_champion@test.com',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('app.trainers.dashboard');
        $this->followRedirects();
        $this->see('Welcome KalosChampion!');
    }

    /** @test */
    public function user_not_trainers_cannot_login()
    {
        $user = factory(User::class)->create(['email' => 'ash_champion_2', 'username' => 'TestTest']);

        $this->call('POST', '/trainers/login', [
            'email'    => 'ash_champion_2@test.com',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('app.trainers.login.showForm');
        $this->followRedirects();
        $this->see('Invalid credentials.');
    }

    /** @test */
    public function user_can_login_as_trainer_using_the_username()
    {
        $this->call('POST', '/trainers/login', [
            'email' => 'KalosChampion',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('app.trainers.dashboard');
        $this->followRedirects();
        $this->see('Welcome KalosChampion!');
    }

    /** @test */
    public function trainer_logged_redirect_to_dashboard()
    {
        $ash = factory(User::class, 'ash')->make();
        $user = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($user->id);

        $this->actingAs($ash_trainer, 'trainer');

        $this->visit('/trainers/login');

        $this->see('Welcome KalosChampion!');
    }
}
