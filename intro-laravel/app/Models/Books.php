<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'summary', 'image', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function borrows()
    {
        return $this->hasMany(Borrows::class, 'book_id');
    }
}
