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
        $occupied = false;
        foreach ($this->tickets as $ticket)
            $ticket->sessao_id === $screening_id ? $occupied = true : $occupied;
        return $occupied;
    }

    public function isInCart()
    {
        $inCart = false;
        foreach (session('cart') as $cart)
            $cart['seat']->id === $this->id ? $inCart = true : $inCart;
        return $inCart;
    }
}
