<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class Operations
{
    // Criptografa um ID para usar em rotas/URLs
    public static function encryptId($id)
    {
        return Crypt::encrypt($id);
    }

    // Descriptografa o ID recebido pela URL, com tratamento de erro
    public static function decryptId($idCriptografado)
    {
        try {
            return Crypt::decrypt($idCriptografado);
        } catch (\Exception $e) {
            return null;
        }
    }

    // Lógica reutilizável: verifica se estoque é válido
    public static function validaEstoque($quantidade)
    {
        return is_numeric($quantidade) && $quantidade >= 0;
    }
}