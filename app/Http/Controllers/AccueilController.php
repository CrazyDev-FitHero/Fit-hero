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

        // Récupère les séries d'exercices en les ordonnant par 'position'
        $randomSerie = SerieExercice::where('numserie', $randomNb)
            ->with('exos') // Charge les exercices associés
            ->orderBy('position') // Assure que les exercices sont ordonnés par position
            ->get();

        return view('accueil', compact('puissance', 'randomSerie'));
    }

}
