<?php

namespace App\Http\Controllers;

use App\Models\Exercice;
use App\Models\SerieExercice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatternController extends Controller
{
    public function validatePattern(Request $request)
    {
        $pattern = $request->input('pattern');
        $patternString = json_encode($pattern);

        $exists = DB::table('exercice')
            ->where('codeexercice', $patternString)
            ->exists();

        if ($exists) {
            return response()->json(['success' => true, 'message' => 'Pattern reconnu!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Pattern inconnu!']);
        }
    }

    public function gagnerstr(Request $request)
    {
        try {
//            $pattern = $request->input('pattern');
//            //echo($pattern);
//            //$patternString = json_decode($pattern);
//
//
//            $exists = Exercice::where('codeexercice', $pattern)->first();
//
//            echo json_encode($exists);
//
//            if (!$exists) throw new \Exception('Pattern inconnu!');
//
            $user = Auth::user();
//            $user->puissance += $exists->gaineexercice;
            $user->puissance += 10;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Puissance gagnée!']);

        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
    }

    public function perdrestr(Request $request)
    {

        $user = Auth::user();
        $user->puissance -= 100;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Puissance perdue!']);
    }



}
