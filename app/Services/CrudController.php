<?php

namespace App\Services;

use Exception;
use App\Traits\Ownerable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseFormatTrait;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CrudController extends Controller
{
    use ApiResponseFormatTrait, Ownerable;
    protected $model;
    protected $resource;
    protected $requestClass;

    public function index(Request $request)
    {
        try {
            $items = $this->model::filterRecords($request);
            return $this->resource::collection($items)->additional($this->preparedResponse('index'));
        } catch (Exception $e) {
            $this->recordException($e);
            return $this->serverErrorResponse($e);
        }
    }

    public function store()
    {
        try {
            $request = app($this->requestClass);
            $item = $this->model::create($request->all());
            return (new $this->resource($item))->additional($this->preparedResponse('store'));
        } catch (QueryException $queryException) {
            return $this->queryExceptionResponse($queryException);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->model::findOrFail($id);

            if (isset($this->model::$isEnableResourceOwnerCheck) && $this->model::$isEnableResourceOwnerCheck === true) {
                if (!$this->isOwner($item)) {
                    return $this->forbiddenAccessResponse();
                }
            }

            return (new $this->resource($item))->additional($this->preparedResponse('show'));
        } catch (ModelNotFoundException $modelException) {
            return $this->recordNotFoundResponse($modelException);
        } catch (Exception $e) {
            return $this->serverErrorResponse($e);
        }
    }

    public function update($id)
    {
        try {
            $request = app($this->requestClass);
            $item = $this->model::findOrFail($id);

            if (isset($this->model::$isEnableResourceOwnerCheck) && $this->model::$isEnableResourceOwnerCheck === true) {
                if (!$this->isOwner($item)) {
                    return $this->forbiddenAccessResponse();
                }
            }

            $item->update($request->all());
            return (new $this->resource($item))->additional($this->preparedResponse('update'));
        } catch (ModelNotFoundException $modelException) {
            return $this->recordNotFoundResponse($modelException);
        } catch (QueryException $queryException) {
            return $this->queryExceptionResponse($queryException);
        }
    }

    public function destroy($id)
    {
        try {
            $item = $this->model::findOrFail($id);

            if (isset($this->model::$isEnableResourceOwnerCheck) && $this->model::$isEnableResourceOwnerCheck === true) {
                if (!$this->isOwner($item)) {
                    return $this->forbiddenAccessResponse();
                }
            }

            $item->status = 'inactive';
            $item->save();
            return (new $this->resource($item))->additional($this->preparedResponse('destroy'));
        } catch (ModelNotFoundException $modelException) {
            return $this->recordNotFoundResponse($modelException);
        } catch (QueryException $queryException) {
            return $this->queryExceptionResponse($queryException);
        }
    }
}
