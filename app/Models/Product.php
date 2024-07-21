<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'categories_id',
        'tags',
    ];

    public function galleries()
    {
        $gallery = $this->hasMany(ProductGallery::class, 'products_id', 'id');
        return $gallery;
    }

    public function category()
    {
        $cat = $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
        return $cat;
    }
}
