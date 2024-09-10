<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    echo "OK!";
    }
}
