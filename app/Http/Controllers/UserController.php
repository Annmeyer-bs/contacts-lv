<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{

    const PER_PAGE = 3;
    public const DEFAULT_SORT_FIELD = 'name';
    public const DEFAULT_SORT_ORDER ='asc';
    protected $sortFields = ['name', 'email', 'adress', 'created_at'];
    protected $sortOrders = ['asc', 'desc'];

    public function index(Request $request)
    {
        $sortField = in_array($request->input('sort_field'),
            $this->sortFields) ? $request->input('sort_field') : self::DEFAULT_SORT_FIELD;
        $sortOrder = in_array($request->input('sort_order'),
            $this->sortOrders) ? $request->input('sort_order') : self::DEFAULT_SORT_ORDER;
        $query = User::orderBY($sortField, $sortOrder);
        $perPage = $request->input('per_page') ?? self::PER_PAGE;

        $users = $query->paginate((int)$perPage);

        return UserResource::collection($users);
    }

}
