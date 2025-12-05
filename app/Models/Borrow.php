<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'borrower', 'borrow_date', 'status'];

    // Relationship to Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
