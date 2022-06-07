<?php

namespace Tests\Feature\API;

use App\Models\Role;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class AuthenticationTest extends TestCase
{
    public function testAdminCanViewAllUsers()
    {
        $user = User::factory()->create();
        $user->syncRoles(['admin']);

        $response = $this->actingAs($user)->get('/api/users');
        $response->assertOk();
    }

    public function testUserCantViewAllUsers()
    {
        $user = User::factory()->create();
        $user->syncRoles(['user']);

        $response = $this->actingAs($user)->get('/api/users');
        $response->assertStatus(403);
    }

    public function testNewUserHaveRoleUser()
    {
        $user = User::factory()->make();

        $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $roles = $this->get('/api/role')->decodeResponseJson();

        $this->assertTrue(count($roles) === 1);
        $this->assertTrue($roles[0]["name"] == 'user');
    }
    public function testUserCanSeeOnlySelfUser()
    {
        $user = User::factory()->create();
        $user->syncRoles(['user']);

        $response = $this->actingAs($user)->get('/api/users/' . $user->id);
        $response->assertOk();

        $anotherUser = User::factory()->create();
        $anotherUser->syncRoles(['user']);

        $response = $this->actingAs($user)->get('/api/users/' . $anotherUser->id);
        $response->assertStatus(403);
    }
}
