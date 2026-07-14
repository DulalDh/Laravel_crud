@extends('app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="border-primary-subtle px-4 py-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
                    <div class="me-lg-4">
                        <h1 class="h3 mb-1">Courses</h1>
                        <p class="text-muted mb-0">Review, search, and manage course records.</p>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
                        <form action="{{ route('course.index') }}" method="GET" class="d-flex flex-column flex-sm-row gap-2" data-debounced-search-form>
                            <div class="input-group">
                                <input
                                    type="search"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search courses"
                                    value="{{ request('search') }}"
                                    data-debounced-search-input
                                >
                            </div>
                        </form>

                        <a href="{{ route('course.create') }}" class="btn btn-primary text-nowrap">
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-3 px-4 pb-4">

                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Students</th>
                                <th scope="col" class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <th scope="row">{{ $course->id }}</th>
                                    <td class="fw-semibold">{{ $course->title }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td class="text-center">
                                        @php
                                            $attachedStudentIds = $course->students
                                                ->pluck('id')
                                                ->map(fn ($studentId) => (string) $studentId)
                                                ->all();
                                        @endphp

                                        @if ($course->students->isNotEmpty())
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary btn-sm"
                                                data-course-attach-trigger
                                                data-course-id="{{ $course->id }}"
                                                data-course-title="{{ $course->title }}"
                                                data-attached-student-ids='@json($attachedStudentIds)'
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#studentCourseDrawer"
                                                aria-controls="studentCourseDrawer"
                                            >
                                                {{ $course->students->count() }}
                                            </button>
                                        @else
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary btn-sm"
                                                data-course-attach-trigger
                                                data-course-id="{{ $course->id }}"
                                                data-course-title="{{ $course->title }}"
                                                data-attached-student-ids="[]"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#studentCourseDrawer"
                                                aria-controls="studentCourseDrawer"
                                            >
                                            +                                            
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('course.edit', $course->id) }}" class="btn btn-outline-secondary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?, You want to delete course')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="studentCourseDrawer" aria-labelledby="studentCourseDrawerLabel">
        <div class="offcanvas-header border-bottom">
            <div>
                <h5 class="offcanvas-title mb-1" id="studentCourseDrawerLabel">Attach Students</h5>
                <p class="text-muted mb-0 small" id="studentCourseDrawerStudent">Select students for this course.</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <form id="studentCourseAttachForm" action="{{ route('course.students.store', 0) }}" method="POST" class="d-flex flex-column h-100">
            @csrf
            <div class="offcanvas-body d-flex flex-column gap-3">
                <input type="hidden" name="course_id" id="studentCoursecourseId" value="">

                <div class="position-sticky top-0 bg-body pt-1 pb-2" style="z-index: 1;">
                    <div class="input-group">
                        <span class="input-group-text">Search</span>
                        <input type="search" class="form-control" placeholder="Find a student" data-student-search>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="1" id="stuSelectAll" data-student-select-all>
                        <label class="form-check-label" for="stuSelectAll">All students</label>
                    </div>
                </div>

                <div class="flex-grow-1 overflow-auto pe-1" data-course-list>
                    @forelse ($students as $student)
                        <div class="form-check border rounded-3 px-5 py-2 mb-2" data-course-row data-course-title="{{ strtolower($student->name) }}">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="student_ids[]"
                                value="{{ $student->id }}"
                                id="student-{{ $student->id }}"
                                data-course-checkbox
                            >
                            <label class="form-check-label ms-2 w-100" for="student-{{ $student->id }}">
                                {{ $student->name }} ({{ $student->email }})
                            </label>
                        </div>
                    @empty
                        <div class="alert alert-warning mb-0">
                            No students available.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="offcanvas-footer border-top p-3 bg-body sticky-bottom">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill" id="studentCourseAttachButton">
                        Attach
                    </button>
                    <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="offcanvas">
                        Close
                    </button>
                </div>
            </div>
        </form>
    </div>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const drawer = document.getElementById('studentCourseDrawer');
            const drawerCourse = document.getElementById('studentCourseDrawerStudent');
            const courseIdInput = document.getElementById('studentCoursecourseId');
            const attachForm = document.getElementById('studentCourseAttachForm');
            const attachButton = document.getElementById('studentCourseAttachButton');
            const searchInput = document.querySelector('[data-student-search]');
            const selectAll = document.querySelector('[data-student-select-all]');
            const checkboxes = Array.from(document.querySelectorAll('[data-course-checkbox]'));
            const rows = Array.from(document.querySelectorAll('[data-course-row]'));
            const triggers = Array.from(document.querySelectorAll('[data-course-attach-trigger]'));


            const syncSelectAllState = () => {
                if (!selectAll) {
                    return;
                }

                const visibleCheckboxes = checkboxes.filter((checkbox) => {
                    const row = checkbox.closest('[data-course-row]');
                    return row && row.style.display !== 'none';
                });
                const checkedVisibleCount = visibleCheckboxes.filter((checkbox) => checkbox.checked).length;

                selectAll.checked = visibleCheckboxes.length > 0 && checkedVisibleCount === visibleCheckboxes.length;
                selectAll.indeterminate = checkedVisibleCount > 0 && checkedVisibleCount < visibleCheckboxes.length;
            };

            const syncAllState = () => {
                syncSelectAllState();
            };

            const applyStudentSelection = (trigger) => {
                const courseId = trigger.dataset.courseId ?? '';
                const courseTitle = trigger.dataset.courseTitle ?? 'this course';
                const attachedStudentIds = JSON.parse(trigger.dataset.attachedStudentIds ?? '[]').map(String);

                courseIdInput.value = courseId;
                drawerCourse.textContent = `Select students for ${courseTitle}.`;
                attachForm.action = `{{ url('course') }}/${courseId}/students`;

                checkboxes.forEach((checkbox) => {
                    checkbox.checked = attachedStudentIds.includes(String(checkbox.value));
                });

                if (searchInput) {
                    searchInput.value = '';
                }

                rows.forEach((row) => {
                    row.style.display = '';
                });

                syncAllState();
            };

            triggers.forEach((trigger) => {
                trigger.addEventListener('click', () => {
                    applyStudentSelection(trigger);
                });
            });

            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', syncAllState);
            });

            if (selectAll) {
                selectAll.addEventListener('change', () => {
                    const visibleCheckboxes = checkboxes.filter((checkbox) => {
                        const row = checkbox.closest('[data-course-row]');
                        return row && row.style.display !== 'none';
                    });

                    visibleCheckboxes.forEach((checkbox) => {
                        checkbox.checked = selectAll.checked;
                    });

                    syncAllState();
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    const query = searchInput.value.trim().toLowerCase();

                    rows.forEach((row) => {
                        const title = row.dataset.courseTitle ?? '';
                        row.style.display = title.includes(query) ? '' : 'none';
                    });

                    syncSelectAllState();
                });
            }

            drawer.addEventListener('shown.bs.offcanvas', () => {
                syncAllState();
            });
        });
    </script>
@endsection
