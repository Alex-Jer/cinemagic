<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'filmes';
    protected $fillable = ['titulo', 'genero_code', 'ano', 'cartaz_url', 'sumario', 'trailer_url', 'custom'];
}
