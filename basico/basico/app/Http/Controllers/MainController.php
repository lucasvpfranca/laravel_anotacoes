<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index() {

        $id = session('user.id');
            // $user = User::find($id)->toArray();
            $notes =  User::find($id)->notes()->get()->toArray();

            // echo "<pre>";
            // print_r($user);
            // print_r($notes);
            // die();
            return view('home', ['notes' => $notes]);
    }



    public function newNote() {

        return view('new_note');
    }
    public function newNoteSubmit(Request $r) {
        echo "Criado nota";
    }

    public function editNote($id) {

        $id = Operations::decryptId($id);


    }

    public function deleteNote($id) {

        $id = Operations::decryptId($id);
        // $id = $this->decryptId($id);


    }



}
