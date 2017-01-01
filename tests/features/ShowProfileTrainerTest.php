<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;

class ShowProfileTrainerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function trainer_can_see_his_own_profile()
    {
        $user = factory(User::class)->create(['name' => 'Ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'email' => 'ash_champion@test.com']);
        Trainer::create(['user_id' => $user->id]);

        $this->actingAs($user);

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
        $ash = factory(User::class)->create(['name' => 'Ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'email' => 'ash_champion@test.com']);
        Trainer::create(['user_id' => $ash->id]);
        $alain = factory(User::class)->create(['name' => 'Alain', 'lastname' => 'Emo', 'birthday' => '1995-06-06', 'username' => 'Alain123', 'email' => 'alain@test.com']);
        Trainer::create(['user_id' => $alain->id]);

        $this->actingAs($ash);

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
        $ash = factory(User::class)->create(['name' => 'Ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'email' => 'ash_champion@test.com']);
        Trainer::create(['user_id' => $ash->id]);

        $this->actingAs($ash);

        $this->call('GET', '/trainers/profile/Alain123');

        $this->assertResponseStatus(404);
    }
}
