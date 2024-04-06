<?php
namespace App\Models\Pets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadastros extends Model
{
    use HasFactory;
    protected $table = 'cadastro_pets';

    protected $fillable = [
        'celular', 
        'cep', 
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'user_id', 
    ];
}
