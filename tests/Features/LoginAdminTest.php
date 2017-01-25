<?php

namespace TestZone\Features;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Admin;

use TestZone\Traits\ActingAs;

class LoginAdminTest extends TestCase
{
    use DatabaseMigrations;
    use ActingAs;

    /** @test */
    public function user_can_login_as_admin_in_application_using_the_email()
    {
        $admin = factory(Admin::class, 'admin')->create();

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
        $this->beAdmin();

        $this->visit('/awesome/login');

        $this->see('Welcome admin-sama!');
    }

}
