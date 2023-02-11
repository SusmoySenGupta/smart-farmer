<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'is_active',
        'image_url',
        'category_id',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'price' => 'integer',
        'stock' => 'float',
        'is_active' => 'boolean',
    ];

    /**
     * Get the category that owns the Product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault(
            fn() => new Category(['title' => 'Deleted Category'])
        );
    }

    /**
     * Get the user that owns the Product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault(
            fn() => new User(['name' => 'Deleted User', 'email' => 'N/A'])
        );
    }

    /**
     * Get the active products.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the inactive products.
     *
     * @param $query
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Get the products in stock.
     *
     * @param $query
     * @return mixed
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Get the products out of stock.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOutOfStock($query)
    {
        return $query->where('stock', 0);
    }
}
