<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'bilhetes';
    protected $dates = ['updated_at', 'created_at'];
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
        return $this->belongsTo(Receipt::class, 'recibo_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cliente_id');
    }

    public function screening()
    {
        return $this->belongsTo(Screening::class, 'sessao_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'lugar_id');
    }
}
