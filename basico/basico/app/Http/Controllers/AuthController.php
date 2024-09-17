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




    // $users = User::all()->toArray();
    // echo "<pre>";
    // print_r($users);
    // $userModel = new User();
    // $users = $userModel->all()->toArray();


    //     try {

    //         DB::connection()->getPdo();
    //         echo "Conexão OK";

    //     } catch(\PDOException $e) {
    //         echo "Conexão Falhou".$e->getMessage();
    //     }

    $user = User::where('username', $username)
    ->where('deleted_at', NULL)
    ->first();
    // print_r($user);

    if(!$user) {
        return redirect()->back()->withInput()->with('loginError', 'Username ou password incorretos');

    }

    if(!password_verify($password, $user->password)) {
        return redirect()->back()->withInput()->with('loginError', 'Username ou password incorretos');

    }
    $user->last_login = date('Y-m-d H:i:s');
    $user->save();

    session([
        'user' => [
            'id' => $user->id,
            'username' => $user->username
        ]
        ]);
        return redirect()->to('/');
    }


    public function logout() {

        session()->forget('user');
        return redirect()->to('/login');

    }

}
