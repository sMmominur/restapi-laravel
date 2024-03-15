<?php

namespace App\Http\Controllers;

use App\Models\IPList;
use App\Http\Requests\IpRequest;
use App\Http\Resources\IPResource;
use App\Services\CrudController;

class IPController extends CrudController
{
    protected $model = IPList::class;
    protected $resource = IPResource::class;
    protected $requestClass = IpRequest::class;

    // Controller-specific methods can be added here if needed
}
