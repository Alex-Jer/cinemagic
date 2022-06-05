<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $table = 'sessoes';
    protected $fillable = [
        'filme_id',
        'sala_id',
        'data',
        'horario_inicio',
        'custom'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
