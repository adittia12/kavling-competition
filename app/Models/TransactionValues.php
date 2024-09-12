<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionValues extends Model
{
    use HasFactory;

    protected $table = 'transaction_value';

    protected $fillable = [
        'id_kavling',
        'id_direction',
        'id_parameter',
        'value'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
