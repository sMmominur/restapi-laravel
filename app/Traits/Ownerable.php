<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait Ownerable
{
    /**
     * Check if the authenticated user is the owner of the resource.
     *
     * @return bool
     */
    public function isOwner(Model $resource, string $key = 'user_id')
    {
        return Auth::check() && $resource->{$key} === Auth::id();
    }
}
