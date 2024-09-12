<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kavlings extends Model
{
    use HasFactory;

    protected $table = 'kavling';

    protected $fillable = [
        'name_kavling'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
