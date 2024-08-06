<?php

use App\Http\Controllers\Pets\CadastrosControllers;
use App\Http\Controllers\pets\LarTemporarioConroller;
use App\Http\Controllers\pets\loginController;
use App\Http\Controllers\pets\MeusPetsController;
use App\Http\Controllers\pets\tiposDePetsController;
use App\Models\Pets\Cadastros;
use App\Models\pets\LarTemporario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/login',[login::class],'index' );
  Route::post('/login', [loginController::class, 'index']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
















Route::GET('/meuspets/react/vacinasLista/{pet_id}', [MeusPetsController::class, 'GetVacinas'])->name("Vacinas.info");







Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cadastro/save', [CadastrosControllers::class, 'salvar'])->name("Cadastro.salvar");
    Route::post('/larTemporario/save', [LarTemporarioConroller::class, 'salvar'])->name("lar.salvar");
    Route::post('/meusPets/save', [MeusPetsController::class, 'salvar'])->name("meusPets.salvar");
    Route::post('/meusPets/update', [MeusPetsController::class, 'update'])->name("Pet.update");
    Route::post('/meusPets/vacina', [MeusPetsController::class, 'vacina'])->name("Pet.vacina");
    Route::post('/meusPets/vacina/deletar', [MeusPetsController::class, 'DeleteVacina'])->name("Pet.DeleteVacina");
    Route::post('/meusPets/vacina/editar', [MeusPetsController::class, 'EditaVacina'])->name("Pet.EditaVacina");

    /************************Para o React*************************************************************************/
    Route::post('/cadastro/react/dadosPessoais', [CadastrosControllers::class, 'DadosPessoais'])->name("Cadastro.ReactDados");
    Route::post('/larTemp/react/dadosIniciais', [LarTemporarioConroller::class, 'GetLarTemp'])->name("larTemp.DadosIniciais");
    Route::post('/pets/react/listaPets', [MeusPetsController::class, 'ListandoMeusPets'])->name("MeusPets.listas");

    Route::get('/pets/react/DadosDoPet', [MeusPetsController::class, 'DadosDoPet'])->name("MeusPets.Dados");
    Route::get('/pets/react/tipos', [tiposDePetsController::class, 'listaTipos'])->name("Tipos.all");
    
    /*************************************************************************************************************/

});


