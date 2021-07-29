<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roupas extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'cor',
        'tamanho',
        'valor',
    ];
}
