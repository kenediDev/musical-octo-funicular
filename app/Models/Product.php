<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $fillable = ["name", "image", "price", "stock", "sold", "category_id", "user_id"];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
