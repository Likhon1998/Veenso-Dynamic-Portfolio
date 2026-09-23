<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_logout_via_post(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_admin_dashboard_shows_working_logout_and_notifications(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'name' => 'Veenso Admin',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee(route('admin.logout'), false);
        $response->assertSee(route('admin.contact-messages.index'), false);
        $response->assertSee('Log out', false);
    }
}
