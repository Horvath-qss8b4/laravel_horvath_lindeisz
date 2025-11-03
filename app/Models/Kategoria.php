<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
 {
    use HasFactory;

    protected $table = 'kategoriak';
    protected $fillable = [ 'nev', 'ar' ];
    public $timestamps = true;

    public function pizzak()
    {
        return $this->hasMany( Pizza::class, 'kategoria_id' );
    }
}
