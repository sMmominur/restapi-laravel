<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name','slug','status','description'];
    protected $perPage = 10;

    public static function filterRecords(Request $request)
    {
        return self::query()
            // Apply a 'where' clause for 'slug' if the 'slug' parameter is provided in the request
            ->when($request->filled('slug'), function ($query) use ($request) {
                return $query->where('slug', $request->query('slug'));
            })
            // Apply a 'where' clause for 'status' if the 'status' parameter is provided in the request
            ->when($request->filled('status'), function ($query) use ($request) {
                return $query->where('status', $request->query('status'));
            })
            // Apply a 'where' clause for 'name' if the 'name' parameter is provided in the request
            ->when($request->filled('name'), function ($query) use ($request) {
                return $query->where('name', $request->query('name'));
            })
            ->paginate();
    }
}
