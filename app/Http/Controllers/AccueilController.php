<?php

namespace App\Http\Controllers;


use App\Models\SerieExercice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccueilController extends Controller
{
    public function index()
    {


        $user = Auth::user();
        $puissance = $user->puissance;

        $maxNumSerie = SerieExercice::max('numserie');

        $randomNb = random_int(1, $maxNumSerie);

        $randomSerie = SerieExercice::where('numserie', $randomNb)
            ->with('exos')
            ->orderBy('position')
            ->get();



        return view('accueil', compact('puissance', 'randomSerie'));
    }

}
