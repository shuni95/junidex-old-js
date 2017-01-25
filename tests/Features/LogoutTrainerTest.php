<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Trainer;

class LogoutTrainerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function trainer_can_logout_on_index_page()
    {
        $ash = factory(Trainer::class, 'ash')->create();

        $this->actingAs($ash, 'trainer');

        $this->visit('/');

        $this->see('KalosChampion');

        $this->press('Logout');

        $this->dontSee('KalosChampion');
    }
}
