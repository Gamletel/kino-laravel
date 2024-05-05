<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Film extends Model
{
    use HasFactory;
    use Searchable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'date',
        'genre'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function film_genres(): HasMany
    {
        return $this->hasMany(Film_Genre::class);
    }

    public function searchableAs():string
    {
        return 'films_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray():array
    {
        return array_merge($this->toArray(),[
            'id' => (string) $this->id,
            'name'=> $this->name,
            'created_at' => $this->created_at->timestamp,
        ]);
    }
}
