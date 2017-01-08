<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Admin;

class LoginAdminTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_login_as_admin_in_application_using_the_email()
    {
        $this->call('POST', '/awesome/login', [
            'email'    => 'admin@admin.com',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('admin.dashboard');
        $this->followRedirects();
        $this->see('Welcome admin-sama!');
    }

    /** @test */
    public function admin_logged_redirect_to_dashboard()
    {
        $admin = factory(User::class, 'admin')->make();
        $user = User::where('username', $admin->username)->first();
        $admin = Admin::find($user->id);

        $this->actingAs($admin, 'admin');

        $this->visit('/awesome/login');

        $this->see('Welcome admin-sama!');
    }

}
