<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $user = Auth::user();
        $dados['MeuId'] = $user->id;
        $token = $user->createToken('MyAppToken')->plainTextToken;
        return  view('pets.home')->with("dados",$user->id)->with("token",$token);
    }


    public function Cadastro(){
        return  view('pets.home');
    }



}
