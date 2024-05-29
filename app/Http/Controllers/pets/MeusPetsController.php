<?php

namespace App\Http\Controllers\pets;

use App\Http\Controllers\Controller;
use App\Models\pets\MeusPets;
use App\Models\Pets\vacinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    /*************************************************************/













    /*************************************************************/
    public function ficha($parametro)
    {

        $user = Auth::user();

        $user_id = $user->id; // Obtém o ID do usuário autenticado

        $token = $user->createToken('MyAppToken')->plainTextToken;
        $dados = explode(".", $parametro);
        $user_id = $dados[1];
        $pet = $dados[0];
        $dados = MeusPets::where('user_id', $user_id)
            ->where('id', $pet)
            ->first();

        $vacinas = $this->GetVacinas($pet);


        return view('pets.pets.ficha', compact('dados', 'token', 'user_id', 'vacinas'));
    }
    /*************************************************************/


    public function  fichaSimples($parametro)
    {
        $dados = explode(".", $parametro);
        $user_id = $dados[1];
        $pet = $dados[0];

        $dados = MeusPets::where('user_id', $user_id)
            ->where('id', $pet)
            ->first();

        if (!$dados) {
            return "nada localizado"; //view('pets.pets.semDados');
        }

        return view('pets.pets.fichaSimples', compact('dados'));
    }









    /*************************************************************/
    public function vacina(Request $request)
    {
        $pet_id = $request->input('pet_id');
        $vacina = $request->input('vacina');
        $data = $request->input('data');
        $proxima = $request->input('proxima');

        $vac = new vacinas();
        $vac->pet_id  = $pet_id;
        $vac->vacina  = $vacina;
        $vac->data    = $data;
        $vac->proxima = $proxima;


        if ($vac->save()) {
            return response()->json(['status' => 'success', 'message' => 'deu certo', "dados" => $this->GetVacinas($pet_id)], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'deu erro', 'idPet' => $pet_id], 500);
        }
    }
    /*************************************************************/
    /*************************************************************/





    /**************************************************************/
    /**************************************************************/
    public function EditaVacina(Request $request)
    {
        $id      =  $request->input('id');
        $vacina  = $request->input('vacina');
        $data    = $request->input('data');
        $proxima = $request->input('proxima');
        $pet = $request->input('pet');

        $vac    = new vacinas();
        $dados  = $vac::find($id);
        $x = $dados->update([
            'vacina'    => $vacina,
              'data'    => $data,
              'proxima' => $proxima
        ]);

        if($x) {
            return response()->json(['status' => 'success', 'message' => 'deu certo', "dados" => $this->GetVacinas($pet)], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'deu erro', 'idPet' => $pet], 500);
        }


        echo json_encode($request->all());

    }
    /**************************************************************/
    /**************************************************************/



    /*************************************************************/
    /*************************************************************/
    public function DeleteVacina(Request $request)
    {
        $vac = new vacinas();
        $id = $request->input('id');
        $pet = $request->input('pet');

        if ($vac::where("id", $id)->first()->delete()) {

            return response()->json(['status' => 'success', 'message' => 'deu certo', 'dados' => $this->GetVacinas($pet)], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'deu erro'], 500);
        }
    }

    /**************************************************************/
    /**************************************************************/




    /**************************************************************/
    /**************************************************************/
    private function GetVacinas($pet_id)
    {
        $vac = new vacinas();
        $dados = $vac::where('pet_id', $pet_id)->get();
        return $dados;
    }
    /**************************************************************/
    /**************************************************************/




    /*************************************************************/
    public function update(Request $request)
    {
        $fotoPath = 0;

        // Busca o registro existente pelo id
        $cadastro = MeusPets::find($request->input('id'));

        // Verifica se o registro existe
        if ($cadastro) {
            $cadastro->user_id = $request->input('user_id');
            $cadastro->nome = $request->input('nome');
            $cadastro->tipo = $request->input('tipo');
            $cadastro->descricao = $request->input('descricao');

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('fotos', 'public');
                $cadastro->foto = $fotoPath;
            }

            // Salva as alterações
            if ($cadastro->save()) {
                return response()->json(['status' => 'success', 'all' => $request->all(), 'message' => 'Registro atualizado com sucesso']);
            }
        } else {

            $cadastro = MeusPets::create([
                'user_id' => $request->input('user_id'),
                'nome' => $request->input('nome'),
                'tipo' => $request->input('tipo'),
                'foto' => $fotoPath, // FotoPath pode estar vazio se não houver arquivo enviado
            ]);



            return response()->json(['status' => 'success', 'all' => $request->all(), 'message' => 'Novo registro criado com sucesso']);
        }


        return response()->json(['status' => 'error', 'message' => 'Erro ao atualizar o registro'], 500);
    }


    /*************************************************************/







    public function ListandoMeusPets(Request $request){
        $user_id =  $request->input('user_id');
        $dadosUsuario = MeusPets::where('user_id', $request->input('user_id'))->get();
        return $dadosUsuario;
    }
}
