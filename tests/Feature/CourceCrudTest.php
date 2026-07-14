<?php

use App\Models\Cource;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

test('course pages are accessible', function (): void {
    get(route('course.index'))
        ->assertOk()
        ->assertSee('Courses');

    get(route('course.create'))
        ->assertOk()
        ->assertSee('Open New Course');
});

test('course can be created updated and deleted', function (): void {
    post(route('course.store'), [
        'title' => 'Laravel Basics',
        'description' => 'Introductory course',
    ])->assertRedirect(route('course.index'));

    $course = Cource::query()->where('title', 'Laravel Basics')->firstOrFail();

    put(route('course.update', $course), [
        'title' => 'Laravel Advanced',
        'description' => 'Updated course',
    ])->assertRedirect(route('course.index'));

    delete(route('course.destroy', $course))
        ->assertRedirect(route('course.index'));

    expect(Cource::query()->where('title', 'Laravel Advanced')->exists())->toBeFalse();
});

test('course validation rejects invalid payloads', function (): void {
    post(route('course.store'), [
        'title' => '',
        'description' => str_repeat('a', 1001),
    ])->assertSessionHasErrors(['title', 'description']);
});
