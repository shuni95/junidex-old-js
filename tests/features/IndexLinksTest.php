<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;

class IndexLinksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_move_to_login_trainers_page()
    {
        $this->visit('/')
             ->click('Login')
             ->seePageIs('/trainers/login');
    }

    /** @test */
    public function trainer_can_see_its_username_instead_of_login_button()
    {
        $ash = factory(User::class, 'ash')->make();
        $trainer = User::where('username', $ash->username)->first()->trainer;

        $this->actingAs($trainer, 'trainer');

        $this->visit('/')
             ->see('KalosChampion')
             ->dontSee('Login');
    }
}
