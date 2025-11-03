<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Kategoria;

class KategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/kategoria.txt');
        if (!File::exists($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with(mb_strtolower($line), 'nev')) continue;

            // TAB szeparált
            $cols = preg_split("/\t+/", $line);
            if (count($cols) < 2) continue;

            $nev = trim($cols[0]);
            $ar = (int) trim($cols[1]);

            // ha véletlenül az "ar" szó kerülne ide, az fejléc, kihagyjuk
            if ($nev === 'ar') continue;

            Kategoria::updateOrCreate(
                ['nev' => $nev],
                ['ar' => $ar]
            );
        }
    }
}
