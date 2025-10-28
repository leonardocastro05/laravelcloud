<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this line


class Categorie extends Model
{
    use HasFactory; // Add this line


    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }
}
