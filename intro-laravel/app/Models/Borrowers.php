<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowers extends Model
{
    use HasFactory;

    protected $table = 'borrowers';
    protected $fillable = ['full_name', 'email', 'phone_number', 'address', 'ic_number', 'ic_image'];

    public function borrows()
    {
        return $this->hasMany(Borrows::class, 'borrowers_id');
    }
}
