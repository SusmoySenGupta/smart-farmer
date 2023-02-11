<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'farmer_id',
        'customer_id',
        'is_delivered',
        'address',
        'total',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'is_delivered' => 'boolean',
        'total' => 'integer',
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'farmer_id', 'id')->withDefault(
            fn() => new User(['name' => 'Deleted Farmer'])
        );
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id')->withDefault(
            fn() => new User(['name' => 'Deleted Customer'])
        );
    }

    /**
     * Get the products for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'amount')
            ->withTimestamps();
    }

    /**
     * Get the delivered orders.
     *
     * @param $query
     * @return mixed
     */
    public function scopeDelivered($query)
    {
        return $query->where('is_delivered', true);
    }

    /**
     * Get the pending orders.
     *
     * @param $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('is_delivered', false);
    }
}
