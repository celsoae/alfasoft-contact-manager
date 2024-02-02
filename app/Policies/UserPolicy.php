<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    public function edit(User $user)
    {
        if (Auth::user())
            return true;

        return false;
    }

    public function delete(User $user)
    {
        if (Auth::user())
            return true;

        return false;
    }
}
