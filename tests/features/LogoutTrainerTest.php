<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;

class LogoutTrainerTest extends TestCase
{
    /** @test */
    public function trainer_can_logout_on_index_page()
    {
        $ash = factory(User::class, 'ash')->make();
        $ash = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($ash->id);

        $this->actingAs($ash_trainer, 'trainer');

        $this->visit('/');

        $this->see('KalosChampion');

        $this->press('Logout');

        $this->dontSee('KalosChampion');
    }
}
