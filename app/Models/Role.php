<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, Filterable;
    
    protected $table = 'roles';
    protected $fillable = ['name','slug','status','description'];
    protected $perPage = 10;

    protected static $filterable = ['slug' => 'slug', 'status' => 'status', 'name' => 'name'];

    public static $isDataFilterAuthorizationEnabled = false;
    public static $isEnableResourceOwnerCheck = false;
}
