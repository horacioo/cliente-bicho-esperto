<?php

namespace App\Http\Controllers\pets;

use App\Http\Controllers\Controller;
use App\Models\pets\MeusPets;
use Illuminate\Http\Request;

class MeusPetsController extends Controller
{


    function Salvar(Request $request)
    {
        // Verifica se o registro já existe
        $cadastro = MeusPets::updateOrCreate(
            [
                'user_id' => $request->input('user_id'),
                'nome' => $request->input('nome'),
                'tipo' => $request->input('tipo')
            ],
            [
                // Se o registro não existir, insere os dados
                'user_id' => $request->input('user_id'),
                'nome' => $request->input('nome'),
                'tipo' => $request->input('tipo'),
                'foto' => '' // Define um valor padrão vazio para foto
            ]
        );
    
        // Verifica se foi enviado um arquivo de foto
        if ($request->hasFile('foto')) {
            // Salva o arquivo de foto e obtém o caminho
            $fotoPath = $request->file('foto')->store('fotos', 'public');
    
            // Atualiza o caminho da foto no registro
            $cadastro->foto = $fotoPath;
            $cadastro->save();
        }
    
        // Retorna todos os dados do usuário
        $dadosUsuario = MeusPets::where('user_id', $request->input('user_id'))->get();
        return $dadosUsuario;
    }
    
    

}
