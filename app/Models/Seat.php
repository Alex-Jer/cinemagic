<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'lugares';
    protected $fillable = [
        'nome',
        'custom'
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class, 'sala_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
