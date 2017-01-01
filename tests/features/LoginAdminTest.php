<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginAdminTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_login_as_admin_in_application_using_the_email()
    {
        $user = factory(User::class)->create(['username'=> 'admin','email' => 'admin@admin.com', 'password' => bcrypt('123456'), 'user_type' => UserTypes::ADMIN_USER]);

        $this->call('POST', '/awesome_login', [
            'email'    => 'admin@admin.com',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('app.admin.dashboard');
        $this->followRedirects();
        $this->see('Welcome admin-sama!');
    }
}
