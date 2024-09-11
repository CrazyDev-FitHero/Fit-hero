<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
