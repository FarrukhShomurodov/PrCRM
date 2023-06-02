<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class specialist extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'dateBirth',
      'speciality'
    ];

    /**
     * @return HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'specialist_id', 'id');
    }
}
