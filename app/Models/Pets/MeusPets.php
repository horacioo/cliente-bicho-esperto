<?php

namespace App\Models\pets;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeusPets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nome', 
        'tipo', 
        'foto', 
        'descricao'
    ];


    public function Tutor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
