<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'balance' => 'integer',
    ];

    /**
     * Get users that are farmers.
     */
    public function scopeFarmer($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'farmer');
        });
    }

    /**
     * Get users that are customers.
     */
    public function scopeCustomer($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        });
    }

    /**
     * Check if the user is a farmer.
     *
     * @return bool
     */
    public function isFarmer(): bool
    {
        return $this->hasRole('farmer');
    }

    /**
     * Check if the user is a customer.
     *
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Get the products for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the products in stock for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsInStock(): HasMany
    {
        return $this->hasMany(Product::class)->where('stock', '>', 0);
    }

    /**
     * Get the orders for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the orders for the farmers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farmerOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'farmer_id', 'id');
    }

    /**
     * Get the cart for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
}
