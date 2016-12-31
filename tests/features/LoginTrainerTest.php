<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;

class LoginTrainerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_login_as_trainer_in_application_using_the_email()
    {
        $user = factory(User::class)->create(['username'=> 'KalosChampion','email' => 'ash_champion@test.com', 'password' => bcrypt('123456')]);
        $trainer = Trainer::create(['user_id' => $user->id]);

        $this->call('POST', '/trainers/login', [
            'email'    => 'ash_champion@test.com',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('app.trainers.dashboard');
        $this->followRedirects();
        $this->see('Welcome KalosChampion!');
    }
}