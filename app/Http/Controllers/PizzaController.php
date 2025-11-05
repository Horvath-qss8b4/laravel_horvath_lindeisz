<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Kategoria;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzak = Pizza::with('kategoria')->paginate(10);
        return view('pizzak.index', compact('pizzak'));
    }

    public function create()
    {
        $kategoriak = Kategoria::all();
        return view('pizzak.create', compact('kategoriak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nev' => 'required|string|max:100',
            'kategoria_id' => 'required|exists:kategoriak,id',
            'vegetarianus' => 'required|boolean',
        ]);

        Pizza::create($request->all());
        return redirect()->route('pizzak.index')->with('success', 'Pizza hozzáadva!');
    }

    public function edit(Pizza $pizzak)
    {
        $kategoriak = Kategoria::all();
        return view('pizzak.edit', ['pizza' => $pizzak, 'kategoriak' => $kategoriak]);
    }

    public function update(Request $request, Pizza $pizzak)
    {
        $request->validate([
            'nev' => 'required|string|max:100',
            'kategoria_id' => 'required|exists:kategoriak,id',
            'vegetarianus' => 'required|boolean',
        ]);

        $pizzak->update($request->all());
        return redirect()->route('pizzak.index')->with('success', 'Pizza módosítva!');
    }

    public function destroy(Pizza $pizzak)
    {
        $pizzak->delete();
        return redirect()->route('pizzak.index')->with('success', 'Pizza törölve!');
    }
}
