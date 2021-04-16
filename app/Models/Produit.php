<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    public $fillable = ["category_id", "designation", "description", "prix", "image"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
