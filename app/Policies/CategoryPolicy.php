<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
//    public function viewAny(User $user): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can view the model.
     */
//    public function view(User $user, Post $post): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can create models.
     */
//    public function create(User $user): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can update the model.
     */
//    public function update(User $user, Post $post): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin): Response
    {
        //
        return $admin-> role == 'SUPER_ADMIN'
            ? Response::allow('success')
            : Response::denyWithStatus(404,'You can not delete this category')
            ;
    }

    /**
     * Determine whether the user can restore the model.
     */
//    public function restore(User $user, Post $post): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can permanently delete the model.
     */
//    public function forceDelete(User $user, Post $post): bool
//    {
//        //
//    }
}
