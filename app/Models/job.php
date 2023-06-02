<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class job extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
       'specialist_id',
       'spent_time'
    ];

    /**
     * @return BelongsTo
     */
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(specialist::class, 'specialist_id', 'id');
    }
}
