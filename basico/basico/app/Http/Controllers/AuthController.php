<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function logout() {
            return "Logout";
    }

    public function loginSubmit(Request $r) {

        $r->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:20',
            ],
            [
                'text_username.required' => 'O email é obrigatório',
                'text_username.email' => 'O email precisa ser válido',
                'text_password.required' => 'A senha é obrigatória',
                'text_password.min' => "A senha precisa ter pelo menos :min caracteres.",

            ]
        );

    $username = $r->input("text_username");
    $password = $r->input("text_password");

    $users = User::all()->toArray();
    echo "<pre>";
    print_r($users);
    $userModel = new User();
    $users = $userModel->all()->toArray();


        try {

            DB::connection()->getPdo();
            echo "Conexão OK";

        } catch(\PDOException $e) {
            echo "Conexão Falhou".$e->getMessage();
        }

    }
}
