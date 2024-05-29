<?php

namespace App\Http\Controllers\Pets;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\CadastroPet;
use App\Models\Pets\Cadastros;
use App\Models\pets\LarTemporario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CadastrosControllers extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dados['MeuId'] = $user->id;
        $dados['email'] = $user->email;


        $token = $user->createToken('MyAppToken')->plainTextToken;

        $cadastro = Cadastros::where('user_id', $user->id)->first();

        $larTemp = LarTemporario::where('user_id', $user->id)->first();

        $PetsData = CadastroPet::where('user_id', $user->id)->get();

        return view('pets.cadastro', compact('dados', 'token', 'cadastro','larTemp', 'PetsData'));

        ///return view('pets.templates.index', compact('dados', 'token', 'cadastro','larTemp', 'PetsData'));


    }




/************************************************************/
/************************************************************/
    public function salvar(Request $request)
    {
        $cadastro = Cadastros::updateOrCreate(
            ['user_id' => $request->input('user_id')],
            [
                'uf'          => $request->input('uf'),
                'cidade'      => $request->input('cidade'),
                'bairro'      => $request->input('bairro'),
                'endereco'    => $request->input('endereco'),
                'complemento' => $request->input('complemento'),
                'numero'      => $request->input('numero'),
                'cidade'      => $request->input('cidade'),
                'cep'         => $request->input('cep'),
                'celular'     => $request->input('celular'),
                'email'       => $request->input('email'),
                'user_id'     => $request->input('user_id'),
            ]
        );

        if ($cadastro) {
            // A operação foi bem-sucedida
            return response()->json(['message' => 'Cadastro salvo com sucesso',"codigo"=>1], 200);
        } else {
            // A operação falhou
            return response()->json(['message' => 'Erro ao salvar o cadastro',"codigo"=>0], 500);
        }
    }
/************************************************************/
/************************************************************/






public function DadosPessoais(request $request){

    $id= $request->input('id');

    $cadastro = Cadastros::where('user_id', $id)->first();

    $user = Auth::user();

    return response()->json(['message' => 'ok','codigo'=>1,"id"=>$id, 'user'=>$user ,'dados'=>$cadastro]);

}



}
