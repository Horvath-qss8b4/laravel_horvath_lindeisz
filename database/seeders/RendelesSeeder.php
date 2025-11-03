<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Rendeles;
use App\Models\Pizza;
use App\Models\User;
use Carbon\Carbon;

class RendelesSeeder extends Seeder
 {
    public function run(): void
 {
        echo '📦 Rendelések feltöltése...\n';

        // admin user
        $user = User::firstOrCreate(
            [ 'email' => 'admin@pizza.hu' ],
            [
                'name' => 'Admin',
                'password' => bcrypt( 'admin123' ),
                'role_id' => 3,
            ]
        );

        $path = database_path( 'seeders/data/rendeles.txt' );
        if ( !File::exists( $path ) ) {
            echo '⚠️ Nincs rendeles.txt fájl!\n';
            return;
        }

        $lines = file( $path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
        $count = 0;

        DB::beginTransaction();
        try {
            foreach ( $lines as $line ) {
                $line = trim( $line );
                if ( $line === '' || str_starts_with( mb_strtolower( $line ), 'pizzanev' ) ) continue;

                $cols = preg_split( '/\t+/', $line );
                if ( count( $cols ) < 4 ) continue;

                [ $pizzanev, $darab, $felvetel, $kiszallitas ] = $cols;
                $pizza = Pizza::whereRaw( 'LOWER(nev) = ?', [ mb_strtolower( trim( $pizzanev ) ) ] )->first();
                if ( !$pizza ) continue;

                $felvetel = str_replace( '.', '-', trim( $felvetel ) );
                $kiszallitas = str_replace( '.', '-', trim( $kiszallitas ) );

                $created = $this->safeDate( $felvetel );
                $updated = $this->safeDate( $kiszallitas );

                // ha bármelyik hibás -> ugrás
                if ( !$created || !$updated ) continue;

                // ha már van ilyen rekord ( pizza + dátum ), ne ismételje
                $exists = Rendeles::where( 'pizza_id', $pizza->id )
                ->where( 'datum', $created )
                ->exists();
                if ( $exists ) continue;

                DB::table( 'rendelesek' )->insert( [
                    'pizza_id'    => $pizza->id,
                    'user_id'     => $user->id,
                    'mennyiseg'   => ( int ) $darab,
                    'datum'       => $created,
                    'created_at'  => $created,
                    'updated_at'  => $updated,
                ] );
                $count++;
            }

            DB::commit();
            echo "✅ {$count} rendelés beszúrva (duplikátumok kihagyva).\n";

        } catch ( \Throwable $e ) {
            DB::rollBack();
            echo '❌ Hiba: ' . $e->getMessage() . '\n';
        }
    }

    private function safeDate( string $value ): ?string
 {
        $v = str_replace( '.', '-', trim( $value ) );

        // ha konkrétan 2006-03-26 02:xx:xx -> tolja 03:xx:xx-ra
        if ( preg_match( '/^2006-03-26 02/', $v ) ) {
            $v = preg_replace( '/^2006-03-26 02/', '2006-03-26 03', $v );
        }

        try {
            $dt = Carbon::createFromFormat( 'Y-m-d H:i:s', $v );
            // ha ez nem sikerült, próbáljunk ISO formátumot
            if ( !$dt ) {
                $dt = Carbon::parse( $v );
            }
            // ha valamiért MySQL még mindig elutasítaná, +1 óra
            if ( $dt->format( 'H' ) == '02' ) {
                $dt->addHour();
            }
            return $dt->format( 'Y-m-d H:i:s' );
        } catch ( \Throwable $e ) {
            // végső fallback – ha semmi nem jó, toljuk +1 órát és térjünk vissza
            try {
                $dt = Carbon::parse( $v )->addHour();
                return $dt->format( 'Y-m-d H:i:s' );
            } catch ( \Throwable $e2 ) {
                // végső megoldás: hagyjuk ki ezt a sort
                echo "⚠️ Kihagyva hibás dátum: $value\n";
                return null;
            }
        }
    }

}
