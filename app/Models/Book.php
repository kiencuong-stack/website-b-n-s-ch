<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'price',
        'quantity',
        'category',
        'publisher',
        'publication_year',
        'description',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'publication_year' => 'integer',
    ];
}
