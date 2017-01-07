<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;
use App\Admin;

class ShowProfileTrainerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function trainer_can_see_his_own_profile()
    {
        $ash = factory(User::class, 'ash')->make();
        $ash = User::where('username', $ash->username)->first();

        $this->actingAs($ash, 'trainer');

        $this->visit('/trainers/me')
             ->see('Ash')
             ->see('Ketchum')
             ->see('14/04/1995')
             ->see('KalosChampion')
             ->see('ash_champion@test.com');
    }

    /** @test */
    public function trainer_can_see_other_trainer_profile()
    {
        $ash = factory(User::class, 'ash')->make();
        $ash = User::where('username', $ash->username)->first();

        $this->actingAs($ash, 'trainer');

        $this->visit('/trainers/profile/Alain123')
             ->see('Alain')
             ->see('Emo')
             ->see('06/06/1995')
             ->see('Alain123')
             ->see('Alain123\'s Profile')
             ->dontSee('alain@test.com');
    }

    /** @test */
    public function trainer_cannot_see_other_trainer_profile_that_doesnot_exists()
    {
        $ash = factory(User::class, 'ash')->make();
        $ash = User::where('username', $ash->username)->first();

        $this->actingAs($ash, 'trainer');

        $this->call('GET', '/trainers/profile/Alain1234');

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function user_not_trainer_cannot_see_trainer_profile_and_redirects_to_register()
    {
        $admin = factory(User::class, 'admin')->make();
        $admin = User::where('username', $admin->username)->first();

        $this->actingAs($admin, 'admin');

        $this->call('GET', '/trainers/profile/Alain123');

        $this->assertRedirectedToRoute('app.trainers.login.showForm');
    }

    /** @test */
    public function admin_user_must_login_as_trainer_to_enter_trainers_section()
    {
        $this->call('POST', '/awesome/login', [
            'email'    => 'admin@admin.com',
            'password' => '123456',
        ]);

        $this->call('GET', '/trainers/me');

        $this->assertRedirectedToRoute('app.trainers.login.showForm');
    }
}
