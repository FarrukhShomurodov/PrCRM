<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'specialist_id',
        'month',
        'year',
        'amount_of_hours',
        'created_at',
        'updated_at'
    ];
}
