<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function view(User $currentUser, User $targetUser)
    {
        return $currentUser->id === $targetUser->id;
    }

    public function update(User $currentUser, User $targetUser)
    {
        return $currentUser->id === $targetUser->id;
    }

    public function delete(User $currentUser, User $targetUser)
    {
        return $currentUser->id === $targetUser->id;
    }
}