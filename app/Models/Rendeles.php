<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendeles extends Model
{
    use HasFactory;

    protected $table = 'rendelesek';
    protected $fillable = ['pizza_id', 'user_id', 'mennyiseg', 'datum'];
    public $timestamps = true;

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
