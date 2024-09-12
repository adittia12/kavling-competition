<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueParameters extends Model
{
    use HasFactory;

    protected $table = 'value_parameter';

    protected $fillable = [
        'name_parameter'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
