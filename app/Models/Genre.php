<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    protected $table = 'generos';

    public function films()
    {
        return $this->hasMany(Film::class, 'genero_code');
    }
}
