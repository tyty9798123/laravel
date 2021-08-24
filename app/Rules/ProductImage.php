<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductImage implements Rule
{
    private $name;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //這裡也可以把值接近來
        //
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
        //
        $this->name = $attribute;
        return preg_match('/^images\/\w+\.(png|jp?g)$/i', $value);
        //["required", "string", "regex:/^images\/\w+\.(png|jp?g)$/i"]
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The validation for $this->name is failed.";
    }
}
