<?php

namespace App\Models;

use App\Models\User;
use App\Models\VideoCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videos extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function videoCategories()
    {
        return $this->belongsTo(VideoCategories::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
