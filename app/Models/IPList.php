<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IPList extends Model
{
    protected $table = 'ip_lists';
    protected $fillable = ['ip_address', 'status', 'ip_type', 'remarks'];
    protected $perPage = 10;

    public static function filterRecords(Request $request)
    {
        return self::query()
            // Apply a 'where' clause for 'ip_address' if the 'ip_address' parameter is provided in the request
            ->when($request->filled('ip_address'), function ($query) use ($request) {
                return $query->where('ip_address', $request->query('ip_address'));
            })
            // Apply a 'where' clause for 'status' if the 'status' parameter is provided in the request
            ->when($request->filled('status'), function ($query) use ($request) {
                return $query->where('status', $request->query('status'));
            })
            // Apply a 'where' clause for 'ip_type' if the 'ip_type' parameter is provided in the request
            ->when($request->filled('ip_type'), function ($query) use ($request) {
                return $query->where('ip_type', $request->query('ip_type'));
            })
            ->paginate();
    }
}
