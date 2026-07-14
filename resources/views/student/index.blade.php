@extends('app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="border-primary-subtle px-4 py-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
                    <div class="me-lg-4">
                        <h1 class="h3 mb-1">Students</h1>
                        <p class="text-muted mb-0">Review, search, and manage student records.</p>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
                        <form action="{{ route('student.index') }}" method="GET" class="d-flex flex-column flex-sm-row gap-2" data-debounced-search-form>
                            <div class="input-group">
                                <input
                                    type="search"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search students"
                                    value="{{ request('search') }}"
                                    data-debounced-search-input
                                >
                            </div>
                        </form>

                        <a href="{{ route('student.create') }}" class="btn btn-primary text-nowrap">
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
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-center">Courses</th>
                                <th scope="col" class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <th scope="row">{{ $student->id }}</th>
                                    <td class="fw-semibold">{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td class="text-center">
                                        @php
                                            $attachedCourseIds = $student->courses->pluck('id')->map(fn ($courseId) => (string) $courseId)->all();
                                        @endphp

                                        @if ($student->courses->isNotEmpty())
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary btn-sm"
                                                data-course-attach-trigger
                                                data-student-id="{{ $student->id }}"
                                                data-student-name="{{ $student->name }}"
                                                data-attached-course-ids='@json($attachedCourseIds)'
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#studentCourseDrawer"
                                                aria-controls="studentCourseDrawer"
                                            >
                                                {{ $student->courses->count() }}
                                            </button>
                                        @else
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary btn-sm"
                                                data-course-attach-trigger
                                                data-student-id="{{ $student->id }}"
                                                data-student-name="{{ $student->name }}"
                                                data-attached-course-ids="[]"
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
                                            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-outline-secondary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?, You want to delete student')">
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
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="studentCourseDrawer" aria-labelledby="studentCourseDrawerLabel">
        <div class="offcanvas-header border-bottom">
            <div>
                <h5 class="offcanvas-title mb-1" id="studentCourseDrawerLabel">Attach courses</h5>
                <p class="text-muted mb-0 small" id="studentCourseDrawerStudent">Select courses for this student.</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <form id="studentCourseAttachForm" action="{{ route('student.courses.store', 0) }}" method="POST" class="d-flex flex-column h-100">
            @csrf
            <div class="offcanvas-body d-flex flex-column gap-3">
                <input type="hidden" name="student_id" id="studentCourseStudentId" value="">

                <div class="position-sticky top-0 bg-body pt-1 pb-2" style="z-index: 1;">
                    <div class="input-group">
                        <span class="input-group-text">Search</span>
                        <input type="search" class="form-control" placeholder="Find a course" data-course-search>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="1" id="courseSelectAll" data-course-select-all>
                        <label class="form-check-label" for="courseSelectAll">All courses</label>
                    </div>
                </div>

                <div class="flex-grow-1 overflow-auto pe-1" data-course-list>
                    @forelse ($courses as $course)
                        <div class="form-check border rounded-3 px-5 py-2 mb-2" data-course-row data-course-title="{{ strtolower($course->title) }}">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="course_ids[]"
                                value="{{ $course->id }}"
                                id="course-{{ $course->id }}"
                                data-course-checkbox
                            >
                            <label class="form-check-label ms-2 w-100" for="course-{{ $course->id }}">
                                {{ $course->title }}
                            </label>
                        </div>
                    @empty
                        <div class="alert alert-warning mb-0">
                            No courses available.
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
            const drawerStudent = document.getElementById('studentCourseDrawerStudent');
            const studentIdInput = document.getElementById('studentCourseStudentId');
            const attachForm = document.getElementById('studentCourseAttachForm');
            const attachButton = document.getElementById('studentCourseAttachButton');
            const searchInput = document.querySelector('[data-course-search]');
            const selectAll = document.querySelector('[data-course-select-all]');
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
                const studentId = trigger.dataset.studentId ?? '';
                const studentName = trigger.dataset.studentName ?? 'this student';
                const attachedCourseIds = JSON.parse(trigger.dataset.attachedCourseIds ?? '[]').map(String);

                studentIdInput.value = studentId;
                drawerStudent.textContent = `Select courses for ${studentName}.`;
                attachForm.action = `{{ url('student') }}/${studentId}/courses`;

                checkboxes.forEach((checkbox) => {
                    checkbox.checked = attachedCourseIds.includes(String(checkbox.value));
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
