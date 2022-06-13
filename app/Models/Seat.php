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
        return $this->hasMany(Ticket::class, 'lugar_id');
    }

    public function isOccupied($screening_id)
    {
        return $this->tickets()->where('sessao_id', $screening_id)->count() > 0;
    }

    public function isInCart()
    {
        if (!session()->has('cart'))
            return false;

        return session('cart')->where('seat', $this)->count() > 0;
    }
}
