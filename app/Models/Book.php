<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';

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

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'book_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'book_id');
    }
}
