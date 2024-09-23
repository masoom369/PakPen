<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'book_id';

    public $incrementing = true;

    protected $fillable = [
        'category_id',
        'seller_id',
        'b_name',
        'b_price',
        'b_description',
        'b_image_path',
        'b_pdf_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
