<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUserCreate extends Model
{
    protected $table = 'book_user_create';
    protected $fillable = ['user_id', 'book_id', 'rating', 'review'];

    public function user() { return $this->belongsTo(User::class); }
    public function book() { return $this->belongsTo(Book::class); }
}
