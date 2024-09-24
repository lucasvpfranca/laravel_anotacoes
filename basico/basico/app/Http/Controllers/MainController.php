<?php

namespace App\Http\Controllers;

use App\Notes;
use App\Services\Operations;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Prompts\Note;
use PHPUnit\Framework\Constraint\Operator;

class MainController extends Controller
{
    public function index() {

        $id = session('user.id');
            // $user = User::find($id)->toArray();
            $notes =  User::find($id)->notes()->whereNull('deleted_at')->get()->toArray();

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

        $r->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],

            [
                'text_title.required'=> "O título é obrigatório",
                'text_title.min' => "O título precisa ter pelo menos :min caracteres",
                'text_title.max' => "O título precisa ter pelo menos :min caracteres",
                'text_note.required'=> "A nota é obrigatória",
                'text_note.min' => "A nota deve ter pelo menos :min caracteres",
                'text_note.max' => "A nota deve ter no máximo :max caracteres"
            ]
        );

        $id = session('user.id');
        $note = new Notes();
        $note->user_id = $id;
        $note->title = $r->text_title;
        $note->text = $r->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function editNote($id) {


        $id = Operations::decryptId($id);

        $note = Notes::find($id);
        return view('edit_note', ['note' =>  $note]);

    }

    public function editNoteSubmit( Request $r) {

        $r->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],

            [
                'text_title.required'=> "O título é obrigatório",
                'text_title.min' => "O título precisa ter pelo menos :min caracteres",
                'text_title.max' => "O título precisa ter pelo menos :min caracteres",
                'text_note.required'=> "A nota é obrigatória",
                'text_note.min' => "A nota deve ter pelo menos :min caracteres",
                'text_note.max' => "A nota deve ter no máximo :max caracteres"
            ]
        );

        if($r->note_id == null) {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($r->note_id);
        $note = Notes::find($id);
        $note->title = $r->text_title;
        $note->text = $r->text_note;
        $note->save();
        return redirect()->route('home');
    }

    public function deleteNote($id) {

        $id = Operations::decryptId($id);
        // $id = $this->decryptId($id);
        $note = Notes::find($id);

        return view('delete_note', ['note' => $note]);


    }
    public function deleteNoteConfirm($id) {
        $id = Operations::decryptId($id);

        $note = Notes::find($id);

        $note->delete();

        // $note->deleted_at = date('Y:m:d H:i:s');
        // $note->save();
        $note->delete();
        return redirect()->route('home');



    }



}
