<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film_Genre extends Model
{
    use HasFactory;

    protected $fillable=[
        'film_id',
        'genre_id',
    ];

    public function films(): HasMany
    {
        return $this->hasMany(Film::class);
    }
}
