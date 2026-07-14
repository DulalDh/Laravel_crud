@php
    $backUrl = $backUrl ?? (url()->previous() !== url()->current() ? url()->previous() : route('home'));
    $backLabel = $backLabel ?? 'Back';
@endphp

<div class="container pt-4">
    <a
        href="{{ $backUrl }}"
        class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 rounded-pill px-3"
        data-back-button
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
        <span>{{ $backLabel }}</span>
    </a>
</div>
