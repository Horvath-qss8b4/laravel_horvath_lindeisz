<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $table = 'pizzak';
    protected $fillable = ['nev', 'kategoria_id', 'vegetarianus'];
    public $timestamps = true;

    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class);
    }
}
