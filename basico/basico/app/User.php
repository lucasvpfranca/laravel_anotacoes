<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Prompts\Note;

class User extends Model
{
    use HasFactory;

    public function notes() {
        return $this->hasMany(Notes::class);
    }
}
