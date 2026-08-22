<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nacionalidade',
        'data_nascimento',
        'biografia',
    ];

    // Relacionamento: um Autor tem vários Livros
    public function livros(): HasMany
    {
        return $this->hasMany(Livro::class);
    }
}