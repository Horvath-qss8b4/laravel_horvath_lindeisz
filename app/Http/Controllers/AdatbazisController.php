<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Kategoria;
use App\Models\Rendeles;

class AdatbazisController extends Controller
{
    public function index()
    {
        $kategoriak = Kategoria::withCount('pizzak')->get();
        $pizzak = Pizza::with('kategoria')->limit(15)->get();
        $rendelesek = Rendeles::with(['pizza', 'user'])->orderByDesc('datum')->limit(15)->get();

        return view('adatbazis', compact('kategoriak', 'pizzak', 'rendelesek'));
    }
}
