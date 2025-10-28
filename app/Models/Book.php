<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use \App\Models\BookUserCreate;

class Book extends Model
{
    use HasFactory; 


    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'synopsis',
        'published_date',
        'price',
        'book_cover',
        'age_rating',
        'categorie_id'
    ];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('nota', 'valoració');
    }
    public function reviews() {
        return $this->hasMany(BookUserCreate::class, 'book_id');
    }
}
