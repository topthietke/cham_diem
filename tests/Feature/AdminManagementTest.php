<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_super_admin_can_view_management_pages(): void
    {
        $evaluator = User::factory()->create(['role' => User::ROLE_EVALUATOR]);
        $superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);

        $this->actingAs($evaluator)
            ->get(route('admin.jobs.index'))
            ->assertForbidden();

        $this->actingAs($superAdmin)
            ->get(route('admin.jobs.index'))
            ->assertOk();
    }

    public function test_creating_admin_account_records_audit_log(): void
    {
        $superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);

        $this->actingAs($superAdmin)
            ->post(route('admin.users.store'), [
                'name' => 'New Evaluator',
                'email' => 'new-evaluator@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => User::ROLE_EVALUATOR,
            ])
            ->assertRedirect(route('admin.users.index'));

        $createdUser = User::where('email', 'new-evaluator@example.com')->firstOrFail();

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $superAdmin->id,
            'action' => 'created',
            'auditable_type' => User::class,
            'auditable_id' => $createdUser->id,
        ]);
    }
}
