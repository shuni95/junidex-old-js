<?php

namespace TestZone\Features;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use TestZone\Traits\ActingAs;

class IndexLinksTest extends TestCase
{
    use DatabaseMigrations;
    use ActingAs;

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
        $ash = $this->beAsh();

        $this->visit('/')
             ->see('KalosChampion')
             ->dontSee('Login');
    }
}
