<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Pizza;
use App\Models\Kategoria;

class PizzaSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/pizza.txt');
        if (!File::exists($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, 'nev')) continue;

            // TAB szeparált oszlopok
            $cols = explode("\t", $line);
            if (count($cols) < 2) continue;

            $nev    = trim($cols[0]);
            $katNev = trim($cols[1]);
            $vega   = isset($cols[2]) ? (int)$cols[2] : 0;

            // Kategória keresése (kisbetű, ékezet mindegy)
            $kat = Kategoria::all()->first(function ($k) use ($katNev) {
                return $this->normalize($k->nev) === $this->normalize($katNev);
            });

            if (!$kat) {
                echo "⚠️ Nincs találat kategóriára: {$katNev} (pizza: {$nev})\n";
                continue;
            }

            Pizza::updateOrCreate(
                ['nev' => $nev],
                [
                    'kategoria_id' => $kat->id,
                    'vegetarianus' => $vega,
                ]
            );
        }
    }

    private function normalize(string $txt): string
    {
        $txt = mb_strtolower(trim($txt));
        $from = ['á','é','í','ó','ö','ő','ú','ü','ű'];
        $to   = ['a','e','i','o','o','o','u','u','u'];
        return str_replace($from, $to, $txt);
    }
}
