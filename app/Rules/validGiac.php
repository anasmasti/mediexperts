<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\{DemandeFinancement,Client,DemandeRemboursementGiac,Giac};

class validGiac implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Le GIAC selectioné n'\est pas le même dans la table clients.";
    }
}
