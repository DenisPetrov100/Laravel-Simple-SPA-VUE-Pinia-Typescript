<?php

namespace Tests\Feature\API;

use App\Models\Payment;
use App\Models\Role;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\assertTrue;

class PaginationTest extends TestCase
{
    public function testAdminCanSeePaginatedUsers()
    {
        /** @var User */
        $admin = User::factory()->create();
        $admin->syncRoles(['admin']);
        $users = User::factory()->count(100)->create();

        foreach($users as $user){
            $user->syncRoles(['user']);
        }

        $response = $this->actingAs($admin)->get('/api/users?page=2');
        $response->assertOk();
        $attributes = json_decode($response->getContent(), true);

        assertTrue(isset($attributes["links"]));
        assertTrue(isset($attributes["links"]["first"]));
        assertTrue(isset($attributes["links"]["last"]));
        assertTrue(isset($attributes["links"]["prev"]));
        assertTrue(isset($attributes["links"]["next"]));
        assertTrue(isset($attributes["meta"]));
        assertTrue(isset($attributes["meta"]["to"]));
        assertTrue(isset($attributes["meta"]["path"]));
        assertTrue(isset($attributes["meta"]["from"]));
        assertTrue(isset($attributes["meta"]["links"]));
        assertTrue(isset($attributes["meta"]["total"]));
        assertTrue(isset($attributes["meta"]["per_page"]));
        assertTrue(isset($attributes["meta"]["last_page"]));
        assertTrue(isset($attributes["meta"]["current_page"]));
    }
}
