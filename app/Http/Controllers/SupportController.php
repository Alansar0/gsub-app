<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SupportTopic;
use Illuminate\Http\Request;


class SupportController extends Controller
{
    public function index()
    {

        $topics = SupportTopic::with('subQuestions')->get();
        $user = auth()->user(); // for prefill

            return view('help.index', compact('topics', 'user'));
    }
}
