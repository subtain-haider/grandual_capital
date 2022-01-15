<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $table = "posts";

    public function topic() {
        return $this->hasOne('App\Models\Topic');
    }
}
