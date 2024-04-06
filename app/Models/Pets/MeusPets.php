<?php

namespace App\Models\pets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeusPets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nome', 
        'tipo', 
        'foto'
    ];
}
