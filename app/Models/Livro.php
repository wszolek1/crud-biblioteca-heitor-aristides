<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'ano_publicacao',
        'quantidade_estoque',
        'autor_id',
        'genero_id',
        'editora_id',
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class);
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class);
    }

    public function editora(): BelongsTo
    {
        return $this->belongsTo(Editora::class);
    }
}
