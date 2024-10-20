<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    use HasFactory;

    protected $table = 'borrows';
    protected $fillable = ['book_id', 'borrow_date', 'return_date', 'borrowers_id', 'status'];

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function borrower()
    {
        return $this->belongsTo(Borrowers::class, 'borrowers_id');
    }
}
