<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Presence;
use App\Models\User;

class PresencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, UserRole::cases());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Presence $presence): bool
    {
        return $user->role === UserRole::Admin || $user->getKey() === $presence->employee->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, UserRole::cases());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Presence $presence): bool
    {
        return $user->role === UserRole::Admin || $user->getKey() === $presence->employee->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Presence $presence): bool
    {
        return $user->role === UserRole::Admin || $user->getKey() === $presence->employee->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Presence $presence): bool
    {
        return $user->role === UserRole::Admin || $user->getKey() === $presence->employee->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Presence $presence): bool
    {
        return $user->role === UserRole::Admin || $user->getKey() === $presence->employee->user_id;
    }
}
