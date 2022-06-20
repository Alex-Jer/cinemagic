<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'recibos';

    protected $dates = ['data', 'updated_at', 'created_at'];

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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cliente_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'recibo_id');
    }
}
