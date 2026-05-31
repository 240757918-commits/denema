<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        $availableLocales = ['ar', 'tr', 'en'];

        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'language' => 'required|in:ar,tr,en',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);

        $lesson->update($validated);

        return redirect()
            ->route('lessons.show', $lesson)
            ->with('success', 'تم تعديل الدرس بنجاح');
    }
}
