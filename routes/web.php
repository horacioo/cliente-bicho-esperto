<?php



use App\Models\CadastroPet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pets\CadastrosControllers;
use App\Http\Controllers\pets\MeusPetsController;
use App\Models\pets\MeusPets;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/***********************************************************************************************************/
Route::get('/', function () {   return view('welcome'); });
Route::get('pet/{parametro}', [MeusPetsController::class, 'fichaSimples' ])->name('petFichaSimples');
/***********************************************************************************************************/
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {  
    Route::get('/dashboard', function () {  return view('dashboard'); })->name('dashboard'); 
    Route::get('/perfil/cadastro', [CadastrosControllers::class, 'index' ])->name('cadastro');
    Route::get('/pet/edit/{parametro}', [MeusPetsController::class, 'ficha' ])->name('petFichaEdit');
});
/***********************************************************************************************************/
