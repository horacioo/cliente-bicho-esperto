<?php

namespace App\Models\Pets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacinas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id', 
        'vacina', 
        'data', 
        'proxima'
    ];
}
