<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\CrudController;

class RoleController extends CrudController
{
    protected $model = Role::class;
    protected $resource = RoleResource::class;
    protected $requestClass = RoleRequest::class;

    // Controller-specific methods can be added here if needed
}
