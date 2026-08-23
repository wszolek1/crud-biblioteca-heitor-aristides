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
        'genero',
        'ano_publicacao',
        'quantidade_estoque',
        'autor_id',
    ];

    // Relacionamento: um Livro pertence a um Autor
    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class);
    }
}