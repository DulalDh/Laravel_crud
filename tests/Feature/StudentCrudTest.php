<?php

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

test('student pages are accessible', function (): void {
    get(route('student.index'))
        ->assertOk()
        ->assertSee('Students');

    get(route('student.create'))
        ->assertOk()
        ->assertSee('Open New Student');
});

test('student can be created updated and deleted', function (): void {
    post(route('student.store'), [
        'name' => 'Test Student',
        'email' => 'student@example.com',
    ])->assertRedirect(route('student.index'));

    $student = Student::query()->where('email', 'student@example.com')->firstOrFail();

    put(route('student.update', $student), [
        'name' => 'Updated Student',
        'email' => 'updated@example.com',
    ])->assertRedirect(route('student.index'));

    delete(route('student.destroy', $student))
        ->assertRedirect(route('student.index'));

    expect(Student::query()->where('email', 'updated@example.com')->exists())->toBeFalse();
});

test('student validation rejects invalid payloads', function (): void {
    post(route('student.store'), [
        'name' => '',
        'email' => 'not-an-email',
    ])->assertSessionHasErrors(['name', 'email']);
});
