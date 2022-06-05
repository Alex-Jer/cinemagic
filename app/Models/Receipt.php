<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'recibos';
    protected $fillable = [
        'cliente_id',
        'data',
        'preco_total_sem_iva',
        'iva',
        'preco_total_com_iva',
        'nif',
        'nome_cliente',
        'tipo_pagamento',
        'ref_pagamento',
        'recibo_pdf_url',
        'custom'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
