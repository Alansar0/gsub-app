<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingLesson;
use App\Models\ReadingQuiz;
use App\Models\Audio;
use App\Models\Quiz;
use App\Models\UserReward;
use Illuminate\Http\Response;



class EarnController extends Controller
{
    public function index()
        {

            return view('earn.index');
        }



    public function morningAzkar()
        {

            $adhkar = include resource_path('views/components/M_adhkar-data.blade.php');

            return view('earn.morningAzkar', compact('adhkar'));
        }


    public function eveningAzkar()
        {
           $adhkar = include resource_path('views/components/E_adhkar-data.blade.php');

            return view('earn.eveningAzkar', compact('adhkar'));


        }

    public function makaranta()
        {

            return view('earn.makaranta.index');
        }

    public function friday()
        {
            return view('earn.friday');
        }

    /**
     * Show the darasi view with audio files.
     *
     * @return \Illuminate\View\View
     */
    public function darasi()
    {
        // Get latest lesson and quizzes
        $lesson = ReadingLesson::latest()->first();
        $quizzesForAudio = $lesson ? $lesson->quizzes : [];

        // Default course
        $course = 'sharrindajjal';

        // Audio directory
        $dir = public_path('audios/' . $course);
        $files = [];

        if (is_dir($dir)) {
            $files = array_values(
                array_filter(
                    scandir($dir),
                    fn($entry) => $entry !== '.' && $entry !== '..' && !is_dir($dir . '/' . $entry)
                )
            );
            natsort($files);
            $files = array_values($files);
        }

        $displayName = ucwords(str_replace(['_', '-'], ' ', $course));

        return view(
            'earn.makaranta.darasi',
            [
                'lesson' => $lesson,
                'quizzesForAudio' => $quizzesForAudio,
                'files' => $files,
                'course' => $course,
                'displayName' => $displayName
            ]
        );

        }


        //
    /**
     * Show audio player for a specific file.
     *
     * @param string $course The course folder name
     * @param string $file The audio file name
     * @return \Illuminate\View\View
     */
    public function sauraro($course, $file)
    {
        $lesson = ReadingLesson::latest()->first();
        $quizzesForAudio = $lesson ? $lesson->quizzes : collect();

        // Get audio file path
        $relPath = 'audios/' . $course . '/' . $file;
        $fullPath = public_path($relPath);

        if (!file_exists($fullPath)) {
            abort(404);
        }

        // Clean display names
        $displayName = ucwords(str_replace(['_', '-'], ' ', $course));
        $displayFile = ucwords(str_replace(['_', '-'], ' ', pathinfo($file, PATHINFO_FILENAME)));

        return view(
            'earn.makaranta.sauraro',
            [
                'lesson' => $lesson,
                'quizzesForAudio' => $quizzesForAudio,
                'course' => $course,
                'file' => $file,
                'path' => $relPath,
                'displayName' => $displayName,
                'displayFile' => $displayFile
            ]
        );
    }


        /**
         * Display the reading view for a specific course and page
         *
         * @param int $pageId
         * @return \Illuminate\View\View
         */
        public function karanta($pageId)
        {
            // Get the current course from the session or default to kurakurai100
            $course = session('current_course', 'kurakurai100');

            // Load course-specific content file
            $contentFile = "components/{$course}.blade.php";
            if (!file_exists(resource_path("views/{$contentFile}"))) {
                abort(404, 'Course content not found.');
            }

            $lessonPages = collect(include resource_path("views/{$contentFile}"));
            $page = $lessonPages->where('page', $pageId)->first();

            // Handle missing pages gracefully
            if (!$page) {
                abort(404, 'Page not found.');
            }

            // Load course-specific quiz data
            $quizConfig = "quiz_data_{$course}";
            $allQuizzes = collect(config($quizConfig, []));
            $pageQuizzes = $allQuizzes->firstWhere('page_id', (int)$pageId);
            $quizzes = $pageQuizzes ? $pageQuizzes['questions'] : [];

            // Get display name for the course
            $displayName = ucwords(str_replace(['_', '-'], ' ', $course));

            return view('earn.makaranta.karanta', compact('page', 'quizzes', 'course', 'displayName'));
    }


    public function submitQuiz(Request $request, $pageId)
    {
        // Get current course from session
        $course = session('current_course', 'kurakurai100');

        // Load course-specific quiz data
        $quizConfig = "quiz_data_{$course}";
        $pageQuizzes = collect(config($quizConfig, []))->firstWhere('page_id', (int)$pageId);
        $quizzes = $pageQuizzes ? $pageQuizzes['questions'] : [];

        // ensure we have questions to check
        if (empty($quizzes)) {
            return back()->with('error', 'No quiz available for this page.');
        }

        $selected = $request->only(['quiz0', 'quiz1']);
        $correctCount = 0;

        foreach ($selected as $key => $answer) {
            $quizIndex = str_replace('quiz', '', $key);
            if (isset($quizzes[$quizIndex]) && $answer == $quizzes[$quizIndex]['correct']) {
                $correctCount++;
            }
        }

        if ($correctCount == count($selected)) {
            return back()->with('success', '✅ Correct! You’ve earned ₦50 reward!');
        }

        return back()->with('error', '❌ Incorrect. Try again after 1 minute.');
    }

    // public function karanta()
    // {
    //     $lesson = ReadingLesson::latest()->first();
    //     $quizzesForAudio = $lesson ? $lesson->quizzes : collect();
    //     return view('earn.makaranta.karanta', compact('lesson', 'quizzesForAudio'));
    // }



    //     public function sauraro()
    //     {
    //          // best: load latest lesson or null
    //     $lesson = ReadingLesson::latest()->first(); // or find by id
    //     return view('earn.makaranta.sauraro', compact('lesson'));
    //     }



    //     public function karanta(ReadingLesson $lesson)
    // {
    //             $lesson = ReadingLesson::latest()->first();

    //     return view('earn.makaranta.karanta', compact('lesson'));
    // }
}
