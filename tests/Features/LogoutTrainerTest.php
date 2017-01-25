<?php

namespace TestZone\Features;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use TestZone\Traits\ActingAs;

class LogoutTrainerTest extends TestCase
{
    use DatabaseMigrations;
    use ActingAs;

    /** @test */
    public function trainer_can_logout_on_index_page()
    {
        $this->beAsh();

        $this->visit('/');

        $this->see('KalosChampion');

        $this->press('Logout');

        $this->dontSee('KalosChampion');
    }
}
