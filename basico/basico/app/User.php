<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Prompts\Note;

class User extends Model
{
    use HasFactory;

    use SoftDeletes;
    public function notes() {

        return $this->hasMany(Notes::class);
    }
}
