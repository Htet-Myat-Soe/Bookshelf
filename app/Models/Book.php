<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        'name',
        'slug',
        'author',
        'page',
        'description',
        'image',
        'book',
        'category_id'
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsToMany(User::class,'user_downloadeds');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
