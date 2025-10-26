<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        public function darasi()
        {

            return view('earn.makaranta.darasi');
        }


        public function sauraro()
        {

            return view('earn.makaranta.sauraro');
        }
}
