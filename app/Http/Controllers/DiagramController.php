<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
 {
    public function index()
 {
        // 1 ) Pizzák száma kategóriánként ( kördiagram )
        $catRows = DB::table( 'kategoriak as k' )
        ->leftJoin( 'pizzak as p', 'p.kategoria_id', '=', 'k.id' )
        ->select( 'k.nev', DB::raw( 'COUNT(p.id) as db' ) )
        ->groupBy( 'k.id', 'k.nev' )
        ->orderBy( 'k.nev' )
        ->get();

        $catLabels = $catRows->pluck( 'nev' );
        $catValues = $catRows->pluck( 'db' );

        // 2 ) Rendelések naponta ( vonaldiagram )
        $ordRows = DB::table( 'rendelesek' )
        ->select( DB::raw( 'DATE(datum) as nap' ), DB::raw( 'SUM(mennyiseg) as darab' ) )
        ->groupBy( DB::raw( 'DATE(datum)' ) )
        ->orderBy( DB::raw( 'DATE(datum)' ) )
        ->get();

        $ordLabels = $ordRows->pluck( 'nap' );
        // 'YYYY-MM-DD'
        $ordValues = $ordRows->pluck( 'darab' );

        return view( 'diagram', [
            'catLabels' => $catLabels,
            'catValues' => $catValues,
            'ordLabels' => $ordLabels,
            'ordValues' => $ordValues,
            'selectedDay' => $ordLabels->last(), // alapértelmezés: legutolsó nap
        ] );

    }
}
