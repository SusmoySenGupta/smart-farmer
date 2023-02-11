<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckProductTitleRule implements Rule
{
    /**
     * @var mixed
     */
    private $user;
    /**
     * @var mixed
     */
    private $ignoreProduct;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user, Product $ignoreProduct = null)
    {
        $this->user = $user;
        $this->ignoreProduct = $ignoreProduct;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $isTitleFound = Product::query()
            ->where('title', $value)
            ->where('user_id', $this->user->id)
            ->when($this->ignoreProduct, function ($query) {
                $query->where('id', '!=', $this->ignoreProduct->id);
            })
            ->exists();

        return !$isTitleFound;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
