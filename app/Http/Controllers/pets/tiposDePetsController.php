<?php

namespace App\Http\Controllers\pets;

use App\Http\Controllers\Controller;
use App\Models\pets\tiposDePets;
use Illuminate\Http\Request;

class tiposDePetsController extends Controller
{

    public function listaTipos()
    {

        $tipos = new tiposDePets();
        $dados = $tipos::all();

        return $dados; 
    }
}
