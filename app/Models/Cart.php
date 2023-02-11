<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'farmer_id',
    ];

    /**
     * Get the user that owns the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                'name' => 'Unknown',
            ]);
    }

    /**
     * Get the farmer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class)
            ->withDefault([
                'name' => 'Unknown',
            ]);
    }

    /**
     * Get the products for the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
