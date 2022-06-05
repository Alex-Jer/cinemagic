<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'bilhetes';
    protected $fillable = [
        'recibo_id',
        'cliente_id',
        'sessao_id',
        'lugar_id',
        'preco_sem_iva',
        'estado',
        'bilhete_pdf_url',
        'bilhete_qrcode_url'
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
