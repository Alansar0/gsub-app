<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserReward;
use Illuminate\Http\Response;



class EarnController extends Controller
{
    public function index()
        {
            $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => auth()->id()]);

            
            $cashback = $wallet->cashback_balance ?? 0;
            $vouchers = $wallet->voucher_balance ?? 0;

            return view('earn.index', compact('cashback', 'vouchers'));

        }



    public function morningAzkar()
        {

            $adhkar = include resource_path('views/components/azkar/M_adhkar-data.blade.php');

            return view('earn.morningAzkar', compact('adhkar'));
        }


    public function eveningAzkar()
        {
           $adhkar = include resource_path('views/components/azkar/E_adhkar-data.blade.php');

            return view('earn.eveningAzkar', compact('adhkar'));


        }

    public function makaranta()
        {

            return view('earn.makaranta.index');
        }

        public function friday($shafi = 1)
            {
                $adhkar = include resource_path('views/components/friday/salawat.blade.php');

                $quran = collect(include resource_path('views/components/friday/suratukahf.blade.php'));
                $page = $quran->firstWhere('page', $shafi);

                if (!$page) {
                    abort(404);
                }

                return view('earn.friday', compact('adhkar', 'page'));
            }

    /**
     * Show the darasi view with audio files.
     *
     * @return \Illuminate\View\View
     */
    public function darasi($course = 'sharrindajjal')
    {
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
    // 🔹 Build audio file path
    $relPath = 'audios/' . $course . '/' . $file;
    $fullPath = public_path($relPath);

    if (!file_exists($fullPath)) {
        abort(404, 'Audio file not found.');
    }

    // 🔹 Display names
    $displayName = ucwords(str_replace(['_', '-'], ' ', $course));
    $displayFile = ucwords(str_replace(['_', '-'], ' ', pathinfo($file, PATHINFO_FILENAME)));

    // 🔹 Load quiz from config/sauraro/
    $quizConfigPath = config_path("sauraro/quiz_data_{$course}.php");
    $quizzes = [];

    if (file_exists($quizConfigPath)) {
        $quizConfig = include($quizConfigPath);
        // Match the audio file name, e.g., "001.mp3"
        $fileQuizzes = collect($quizConfig)->firstWhere('file', $file);
        $quizzes = $fileQuizzes ? $fileQuizzes['questions'] : [];
    } else {
        \Log::warning("Quiz config not found for Sauraro course", [
            'course' => $course,
            'path' => $quizConfigPath
        ]);
    }

    // 🔹 Save course in session (for quiz reward logic)
    session(['current_course' => $course]);

    return view('earn.makaranta.sauraro', [
        'course' => $course,
        'file' => $file,
        'path' => $relPath,
        'displayName' => $displayName,
        'displayFile' => $displayFile,
        'quizzes' => $quizzes
    ]);
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
            $contentFile = "components/karanta/{$course}.blade.php";
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
            $quizConfig = "karanta.quiz_data_{$course}";
            $allQuizzes = collect(config($quizConfig, []));
            $pageQuizzes = $allQuizzes->firstWhere('page_id', (int)$pageId);
            $quizzes = $pageQuizzes ? $pageQuizzes['questions'] : [];

            // Get display name for the course
            $displayName = ucwords(str_replace(['_', '-'], ' ', $course));

            return view('earn.makaranta.karanta', compact('page', 'quizzes', 'course', 'displayName'));
    }

public function submitQuiz(Request $request, $pageId)
{
    $course = session('current_course', 'kurakurai100');
    $type = $request->input('type', 'karanta'); // 🔹 Get quiz type (karanta or sauraro)

    try {
        // 🧩 Load course-specific quiz data dynamically
        $quizConfigPath = config_path("{$type}/quiz_data_{$course}.php");
        if (!file_exists($quizConfigPath)) {
            \Log::error("Quiz config file not found", [
                'path' => $quizConfigPath,
                'course' => $course,
                'type' => $type
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Quiz configuration not found.'
            ]);
        }

        $quizConfig = include($quizConfigPath);

        // 🔍 Locate correct quiz by ID or file name
        $pageQuizzes = collect($quizConfig)->firstWhere(
            $type === 'karanta' ? 'page_id' : 'file',
            $type === 'karanta' ? (int) $pageId : $pageId
        );

        $quizzes = $pageQuizzes ? $pageQuizzes['questions'] : [];

        if (empty($quizzes)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No quizzes available for this lesson yet.'
            ]);
        }

        // 📝 Collect submitted answers
        $submitted = collect($request->all())
            ->filter(fn($v, $k) => str_starts_with($k, 'quiz'))
            ->toArray();

        // ✅ Check answers
        $correctCount = 0;
        foreach ($submitted as $key => $answer) {
            $quizIndex = (int) str_replace('quiz', '', $key);
            if (
                isset($quizzes[$quizIndex]) &&
                (string) $answer === (string) $quizzes[$quizIndex]['correct']
            ) {
                $correctCount++;
            }
        }

        // 💰 Success: All correct
        if ($correctCount > 0 && $correctCount === count($submitted)) {

            // 🔹 Use reward wallet, not main wallet
            $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => auth()->id()]);

            // Add ₦50 cashback
            $wallet->cashback_balance = ($wallet->cashback_balance ?? 0) + 50;

            // Convert ₦200 cashback = 1 voucher
            while ($wallet->cashback_balance >= 200) {
                $wallet->cashback_balance -= 200;
                $wallet->voucher_balance = ($wallet->voucher_balance ?? 0) + 1;
            }

            $wallet->save();

            return response()->json([
                'status' => 'success',
                'message' => '🎉 Correct! You earned ₦50 cashback. Keep going!'
            ]);
        }

        // ❌ Wrong answer case
        return response()->json([
            'status' => 'error',
            'message' => '❌ Incorrect answers. Try again later.'
        ]);

    } catch (\Throwable $e) {
        \Log::error('Quiz submission failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred.'
        ]);
    }
}




}
