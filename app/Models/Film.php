<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'filmes';
    protected $fillable = [
        'titulo',
        'genero_code',
        'ano',
        'cartaz_url',
        'sumario',
        'trailer_url',
        'custom'
    ];

    public function screenings()
    {
        return $this->hasMany(Screening::class, 'filme_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genero_code', 'code');
    }
}
