<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait Filterable
{
    /**
     * Filter records based on the provided request parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Collection
     */
    public static function filterRecords(Request $request)
    {
        $query = self::query();

        $conditions = static::$filterable ?? [];

        // Include user_id condition if isDataFilterAuthorizationEnabled set true from the model
        if (isset(static::$isDataFilterAuthorizationEnabled) && static::$isDataFilterAuthorizationEnabled) {
            $conditions['user_id'] = 'user_id';
            $request->merge(['user_id' => Auth::id()]);
        }

        foreach ($conditions as $key => $column) {
            if ($request->filled($key)) {
                $query->where($column, $request->input($key));
            }
        }

        $items = $query->get();
        $totalItems = $items->count();
        $perPage = self::query()->getModel()->getPerPage();

        if ($totalItems > $perPage) {
            return $query->paginate($perPage);
        } else {
            return $items;
        }
    }
}
