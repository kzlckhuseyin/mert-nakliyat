<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'plate_number',
        'supplier_name',
        'quantity',
        'freight_price',
        'store_code',
        'date',
        'has_vat',
    ];

    protected $casts = [
        'date' => 'date',
        'has_vat' => 'boolean',
    ];
}
