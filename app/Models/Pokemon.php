<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pokemons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
        'name',
        'abilities',
        'habitat',
        'front_default',
        'back_default',
        'front_female',
        'back_female',
        'front_shiny',
        'back_shiny',
        'front_shiny_female',
        'back_shiny_female',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'pokemon_types', 'pokemon_id', 'type_id');
    }
}
