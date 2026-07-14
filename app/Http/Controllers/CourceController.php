<?php

namespace App\Http\Controllers;

use App\Models\Cource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourceController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $courses = Cource::query()
            ->withCount('students')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('course.index', compact('courses'));
    }

    public function create(): View
    {
        return view('course.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Cource::create($validated);

        return redirect()->route('course.index')->with('success', 'Course created successfully.');
    }

    public function edit(Cource $course): View
    {
        return view('course.edit', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Cource $course): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $course->update($validated);

        return redirect()->route('course.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Cource $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
    }
}
