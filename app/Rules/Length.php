<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Length implements Rule
{
    /**
     * @var integer
     */
    private $length;

    /**
     * Create a new rule instance.
     *
     * Length constructor.
     * @param $length
     */
    public function __construct(int $length)
    {
        $this->length = $length;
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
        return strlen($value) === $this->length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans_choice('validations.length', $this->length, ['n' => $this->length]);
    }
}
