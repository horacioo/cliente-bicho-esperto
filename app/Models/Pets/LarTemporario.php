<?php

namespace App\Models\pets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LarTemporario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'disponivel', 
        'tipo', 
        'vagas'
    ];
}
