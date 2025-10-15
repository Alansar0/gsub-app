<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportCostumer;

class SupportCostumerController extends Controller
{
     // USER VIEW
    public function index()
    {
        $questions = SupportCostumer::all();
        return view('support.index', compact('questions'));
    }
}
