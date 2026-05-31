<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // عرض كل الدروس (index)
    public function index()
    {
        $lessons = Lesson::latest()->get();
        return view('sections.lessons.index', compact('lessons'));
    }

    // عرض درس واحد (show)
    public function show(Lesson $lesson)
    {
        return view('sections.lessons.show', compact('lesson'));
    }

    // صفحة التعديل (edit)
    public function edit(Lesson $lesson)
    {
        return view('sections.lessons.edit', compact('lesson'));
    }

    // حفظ التعديلات (update)
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'language'    => 'required|in:ar,tr,en',
            'level'       => 'required|in:beginner,intermediate,advanced',
        ]);

        $lesson->update($validated);

        return redirect()
            ->route('lessons.show', $lesson)
            ->with('success', 'تم تحديث الدرس بنجاح');
    }

    // حذف الدرس (destroy)
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()
            ->route('lessons.index')
            ->with('success', 'تم حذف الدرس');
    }
}
