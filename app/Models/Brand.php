<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale'
    ];
    protected $casts = [
        'image' => 'string',

    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}