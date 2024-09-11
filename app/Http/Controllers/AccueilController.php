<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $puissance=$user->puissance;
        return view('accueil',compact('puissance'));
    }
}
