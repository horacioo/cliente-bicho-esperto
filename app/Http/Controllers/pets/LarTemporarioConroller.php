<?php

namespace App\Http\Controllers\pets;

use App\Http\Controllers\Controller;
use App\Models\pets\LarTemporario;
use Illuminate\Http\Request;

class LarTemporarioConroller extends Controller
{
    public function salvar(Request $request)
    {
       
       $cadastro = LarTemporario::updateOrCreate(
            ['user_id' => $request->input('user_id')],
            [
                'tipo'        => $request->input('animal'),
                'disponivel'  => $request->input('vaga'),
                'vagas'       => $request->input('quantidade'),
                'user_id'     => $request->input('user_id'),
            ]
        );
     
        if ($cadastro) {
            return response()->json(['message' => 'Cadastro salvo com sucesso'], 200);
        } else {
            return response()->json(['message' => 'Erro ao salvar o cadastro'], 500);
        }
    }



    public function GetLarTemp(Request $request){


        ///return response()->json(['message' => $request->input('user_id')], 200);

          $user_id =  $request->input('user_id');

          $larTemp = LarTemporario::where('user_id', $user_id)->first();

          return response()->json(['codigo' => '1', 'dados' => $larTemp], 200);
    }


}
