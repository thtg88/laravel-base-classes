<?php

namespace Thtg88\LaravelBaseClasses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use Thtg88\LaravelBaseClasses\Models\User;

abstract class Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model    $model
     *
     * @return bool
     */
    public function view(User $user, Model $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can search models.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     *
     * @return bool
     */
    public function search(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model    $model
     *
     * @return bool
     */
    public function update(User $user, Model $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model    $model
     *
     * @return bool
     */
    public function delete(User $user, Model $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model    $model
     *
     * @return bool
     */
    public function restore(User $user, Model $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \Thtg88\LaravelBaseClasses\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model    $model
     *
     * @return bool
     */
    public function forceDelete(User $user, Model $model): bool
    {
        return false;
    }
}
