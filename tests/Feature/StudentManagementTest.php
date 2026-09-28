<?php

namespace Tests\Feature;

use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_be_updated_without_a_parent(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_EVALUATOR]);
        $parent = ParentModel::create([
            'name' => 'Parent Name',
            'phone' => '0912345678',
        ]);
        $student = Student::create([
            'name' => 'Student Name',
            'parent_id' => $parent->id,
        ]);

        $this->actingAs($admin)
            ->put(route('admin.students.update', $student), [
                'name' => $student->name,
                'parent_id' => '',
            ])
            ->assertRedirect(route('admin.students.index'));

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'parent_id' => null,
        ]);
    }

    public function test_student_parent_id_must_reference_an_existing_parent_when_provided(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_EVALUATOR]);
        $student = Student::create(['name' => 'Student Name']);

        $this->actingAs($admin)
            ->from(route('admin.students.edit', $student))
            ->put(route('admin.students.update', $student), [
                'name' => $student->name,
                'parent_id' => 999999,
            ])
            ->assertSessionHasErrors('parent_id');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'parent_id' => null,
        ]);
    }

    public function test_student_list_renders_when_parent_is_missing(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_EVALUATOR]);
        Student::create(['name' => 'Student Without Parent']);

        $this->actingAs($admin)
            ->get(route('admin.students.index'))
            ->assertOk()
            ->assertSee('Student Without Parent')
            ->assertSee('Chưa gán');
    }
}