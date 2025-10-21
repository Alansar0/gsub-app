<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetVocherController extends Controller
{
    public function index()
    {
        return view('getVocher.index');
    }
    public function receipt()
    {
        return view('getVocher.receipt');
    }

    public function paycheckout()
    {
        return view('getVocher.paycheckout');
    }
}
