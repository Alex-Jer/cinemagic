<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = ['nif', 'tipo_pagamento', 'ref_pagamento', 'custom'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}