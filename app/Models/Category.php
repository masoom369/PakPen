<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'c_name',
        'c_image_path',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}

