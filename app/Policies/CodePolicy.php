<?php

namespace App\Policies;

use App\Models\Code;
use App\Models\User;

class CodePolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function register(?User $user, Code $code): bool
    {
        return $code->isNotUsed();
    }
}
