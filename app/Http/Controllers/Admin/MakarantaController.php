<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurahAudio;
use App\Models\AudioQuiz;
use App\Models\ReadingLesson;
use App\Models\ReadingQuiz;
use Illuminate\Support\Facades\Storage;

class MakarantaController extends Controller
{


        public function ReadingIndex()
        {
            $lessons = ReadingLesson::with('quizzes')->latest()->get();
            return view('admin.makaranta.readinglesson', compact('lessons'));
        }

            public function textUpload()
        {
            $lessons = ReadingLesson::with('quizzes')->latest()->get();
            return view('admin.makaranta.textUpload', compact('lessons'));
        }


    public function Readingstore(Request $request)
    {
        $request->validate(['title' => 'required', 'content' => 'required']);
        ReadingLesson::create($request->only('title', 'content'));
        return back()->with('success', 'Lesson added successfully!');
    }

    public function ReadingStoreQuiz(Request $request, ReadingLesson $lesson)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'correct_answer' => 'required'
        ]);
        $lesson->quizzes()->create($request->all());
        return back()->with('success', 'Quiz added successfully!');
    }

    public function destroyQuiz(ReadingQuiz $quiz)
    {
        $quiz->delete();
        return back()->with('success', 'Quiz deleted!');
    }

    // public function AudioIndex()
    // {
    //     $audios = SurahAudio::all();
    //     return view('admin.audios.index', compact('audios'));
    // }

    // public function create()
    // {
    //     return view('admin.audios.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'reciter' => 'nullable|string|max:255',
    //         'audio' => 'required|file|mimes:mp3,wav',
    //     ]);

    //     $path = $request->file('audio')->store('audios', 'public');

    //     SurahAudio::create([
    //         'title' => $request->title,
    //         'reciter' => $request->reciter,
    //         'file_path' => $path,
    //     ]);

    //     return redirect()->route('admin.audios.index')->with('success', 'Audio uploaded successfully!');
    // }

    // public function destroy(SurahAudio $audio)
    // {
    //     Storage::disk('public')->delete($audio->file_path);
    //     $audio->delete();

    //     return back()->with('success', 'Audio removed successfully!');
    // }
    // public function index()
    // {
    //     $audios = SurahAudio::with('quizzes')->get();
    //     return view('admin.makaranta.audios', compact('audios'));
    // }

    // public function create()
    // {
    //     return view('admin.makaranta.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'reciter' => 'nullable|string|max:255',
    //         'audio' => 'required|file|mimes:mp3,wav|max:10000',
    //     ]);

    //     $path = $request->file('audio')->store('audios', 'public');

    //     SurahAudio::create([
    //         'title' => $request->title,
    //         'reciter' => $request->reciter,
    //         'file_path' => $path,
    //     ]);

    //     return redirect()->route('admin.audios.index')->with('success', 'Audio uploaded successfully!');
    // }

    // public function destroy(SurahAudio $audio)
    // {
    //     Storage::disk('public')->delete($audio->file_path);
    //     $audio->delete();

    //     return back()->with('success', 'Audio removed successfully!');
    // }

    // // Quiz management
    // public function storeQuiz(Request $request, SurahAudio $audio)
    // {
    //     $request->validate([
    //         'question' => 'required|string',
    //         'option_a' => 'required|string',
    //         'option_b' => 'required|string',
    //         'correct_answer' => 'required|string',
    //     ]);

    //     $audio->quizzes()->create($request->all());

    //     return back()->with('success', 'Quiz added successfully!');
    // }

    // public function destroyQuiz(Quiz $quiz)
    // {
    //     $quiz->delete();
    //     return back()->with('success', 'Quiz removed!');
    // }



}
