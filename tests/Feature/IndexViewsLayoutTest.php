<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('renders the customer list page with a responsive header and table shell', function () {
    get(route('customer.index'))
        ->assertOk()
        ->assertSee('Customers')
        ->assertSee('Review, search, and manage customer records.')
        ->assertSee('Add New')
        ->assertSee('table-responsive', false)
        ->assertSee('table table-hover align-middle mb-0', false);
});

it('renders the student list page with a responsive header and table shell', function () {
    get(route('student.index'))
        ->assertOk()
        ->assertSee('Students')
        ->assertSee('Review, search, and manage student records.')
        ->assertSee('Add New')
        ->assertSee('table-responsive', false)
        ->assertSee('table table-hover align-middle mb-0', false);
});

it('renders the shop list page with a responsive header and table shell', function () {
    get(route('shop.index'))
        ->assertOk()
        ->assertSee('Shops')
        ->assertSee('Review, search, and manage shop records.')
        ->assertSee('Add New')
        ->assertSee('table-responsive', false)
        ->assertSee('table table-hover align-middle mb-0', false);
});

it('renders the course list page with a responsive header and table shell', function () {
    get(route('course.index'))
        ->assertOk()
        ->assertSee('Courses')
        ->assertSee('Review, search, and manage course records.')
        ->assertSee('Add New')
        ->assertSee('table-responsive', false)
        ->assertSee('table table-hover align-middle mb-0', false);
});

it('renders the post list page with a responsive table shell', function () {
    get(route('post.index', 1))
        ->assertOk()
        ->assertSee('Posts')
        ->assertSee('Review posts linked to the selected customer.')
        ->assertSee('table-responsive', false)
        ->assertSee('table table-hover align-middle mb-0', false)
        ->assertDontSee('Add New');
});
