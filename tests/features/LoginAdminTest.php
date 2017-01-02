<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\RoleConstants;
use App\User;
use App\Role;

class LoginAdminTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test */
    public function user_can_login_as_admin_in_application_using_the_email()
    {
        $role = Role::create(['id' => RoleConstants::ADMIN_ROLE, 'name' => 'admin']);
        $user = factory(User::class, 'admin')->create();
        $user->roles()->save($role);

        $this->call('POST', '/awesome/login', [
            'email'    => 'admin@admin.com',
            'password' => '123456',
        ]);

        $this->assertRedirectedToRoute('admin.dashboard');
        $this->followRedirects();
        $this->see('Welcome admin-sama!');
    }
}
