<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller {
    // Űrlap megjelenítése

    public function showForm() {
        return view( 'kapcsolat' );
    }

    // Űrlap feldolgozása

    public function store( Request $request ) {
        $validated = $request->validate( [
            'uzenet' => 'required|string|min:5|max:500',
        ] );

        Message::create( [
            'name'    => Auth::user()->name,
            'email'   => Auth::user()->email,
            'message' => $validated[ 'uzenet' ], // itt 'message', nem 'uzenet'
        ] );

        return redirect()->back()->with( 'success', 'Üzenet sikeresen elküldve!' );
    }
    // Üzenetek listázása

    public function index() {
        // a legfrissebb üzenetek elöl
        $messages = \App\Models\Message::orderBy( 'created_at', 'desc' )->get();

        return view( 'uzenetek', compact( 'messages' ) );
    }

}
