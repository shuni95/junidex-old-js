<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IndexLinksTest extends TestCase
{
    /** @test */
    public function user_can_move_to_login_trainers_page()
    {
        $this->visit('/')
             ->click('Login')
             ->seePageIs('/trainers/login');
    }
}
