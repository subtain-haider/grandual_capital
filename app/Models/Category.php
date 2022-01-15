<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'p_categories';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
