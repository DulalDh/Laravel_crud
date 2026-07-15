@php
    $backUrl = url()->previous() !== url()->current() ? url()->previous() : route('home');
@endphp

<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 sticky-top">
    <div class="container">
      <div class="d-flex align-items-center gap-2">
        <a
          href="{{ $backUrl }}"
          class="btn btn-outline-secondary btn-sm rounded-pill px-3 d-inline-flex align-items-center gap-2"
          aria-label="Go back"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            aria-hidden="true"
            focusable="false"
          >
            <path
              d="M6.854 3.646a.5.5 0 0 1 0 .708L3.707 7.5H13.5a.5.5 0 0 1 0 1H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708 0Z"
              fill="currentColor"
            />
          </svg>
          <span class="d-none d-sm-inline">Back</span>
        </a>

        <a class="navbar-brand fw-bold fs-4 text-primary mb-0" href="{{ url('/') }}">
          DH <span class="text-dark">Store</span>
        </a>
      </div>

      <!-- Mobile Toggle Hamburger -->
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible Content -->
      <div class="collapse navbar-collapse" id="navbarContent">
        
        <!-- Centered or Right-Aligned Links -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-lg-3">
          <li class="nav-item">
            <a
              class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
              @if (request()->routeIs('home')) aria-current="page" @endif
              href="{{ route('home') }}"
            >
              Home
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{ request()->routeIs('shop.*') ? 'active fw-semibold' : '' }}"
              @if (request()->routeIs('shop.*')) aria-current="page" @endif
              href="{{ route('shop.index') }}"
            >
              Shops
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{ request()->routeIs('customer.*') || request()->routeIs('post.index') ? 'active fw-semibold' : '' }}"
              @if (request()->routeIs('customer.*') || request()->routeIs('post.index')) aria-current="page" @endif
              href="{{ route('customer.index') }}"
            >
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{ request()->routeIs('student.*') ? 'active fw-semibold' : '' }}"
              @if (request()->routeIs('student.*')) aria-current="page" @endif
              href="{{ route('student.store') }}"
            >
              Students
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link {{ request()->routeIs('course.*') ? 'active fw-semibold' : '' }}"
              @if (request()->routeIs('course.*')) aria-current="page" @endif
              href="{{ route('course.index') }}"
            >
              Courses
            </a>
                        <a
              class="nav-link {{ request()->routeIs('join.*') ? 'active fw-semibold' : '' }}"
              @if (request()->routeIs('join.*')) aria-current="page" @endif
              href="{{ route('join.index') }}"
            >
              Check Join
            </a>
          </li>
        </ul>
        
        <!-- Call to Action Buttons -->
        <div class="d-flex flex-column flex-lg-row ms-lg-4 gap-2 mt-3 mt-lg-0">
          <a href="#" class="btn btn-light rounded-pill px-4 fw-medium border">Log In</a>
        </div>
        
      </div>
    </div>
  </nav>
