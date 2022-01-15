<?php

namespace App\Models;

use App\Models\Videos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoCategories extends Model
{
    use HasFactory;
    public function videos()
    {
        return $this->hasMany(Videos::class);
    }
}
