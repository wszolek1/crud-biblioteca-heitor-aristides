<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class Operations
{
    public static function encryptId($id)
    {
        return Crypt::encrypt($id);
    }

    public static function decryptId($idCriptografado)
    {
        try {
            return Crypt::decrypt($idCriptografado);
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function validaEstoque($quantidade)
    {
        return is_numeric($quantidade) && $quantidade >= 0;
    }
}