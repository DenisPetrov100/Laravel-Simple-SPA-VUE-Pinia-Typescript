<?php

namespace Tests\Feature\API;

use App\Models\Payment;
use App\Models\Role;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class PaymentTest extends TestCase
{
    public function testUserCanSeeOnlySelfPayment()
    {
        /** @var User */
        $user = User::factory()->create();
        Payment::factory(10)->amount(10)->user($user->id)->create();
        $user->syncRoles(['user']);

        $response = $this->actingAs($user)->get('/api/payments');
        $payments = json_decode($response->getContent(), true)["data"];
        $this->assertTrue(count($payments) === 10);
        $response->assertOk();

        $response = $this->actingAs($user)->get('/api/payments?' . 'id=' . $user->id);
        $payments = json_decode($response->getContent(), true)["data"];
        $this->assertTrue(count($payments) === 10);
        $response->assertOk();

        /** @var User */
        $anotherUser = User::factory()->create();
        $anotherUser->syncRoles(['user']);

        $response = $this->actingAs($anotherUser)->get('/api/payments?' . 'id=' . $user->id);
        $response->assertStatus(403);
    }

    public function testAdminCanSeeAllPayment()
    {
        /** @var User */
        $admin = User::factory()->create();
        $admin->syncRoles(['admin']);

        $response = $this->actingAs($admin)->get('/payments');
        $response->assertOk();

        $anotherUser = User::factory()->create();
        $anotherUser->syncRoles(['user']);

        $response = $this->actingAs($admin)->get('/api/users/' . $anotherUser->id . '/payments');
        $response->assertOk();
    }
}
