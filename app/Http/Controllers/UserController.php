<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{

    const PER_PAGE = 5;
    public const DEFAULT_SORT_FIELD = 'name';
    public const DEFAULT_SORT_ORDER = 'asc';
    protected $sortFields = ['id', 'name', 'email', 'adress', 'created_at'];
    protected $sortOrders = ['asc', 'desc'];

    public function index(Request $request)
    {
        $sortFieldInput = $request->input('sort_field', self::DEFAULT_SORT_FIELD);
        $sortField = in_array($sortFieldInput, $this->sortFields) ? $sortFieldInput : self::DEFAULT_SORT_FIELD;;

        $sortOrder = $request->input('sort_order', self::DEFAULT_SORT_ORDER);

        $query = User::orderBY($sortField, $sortOrder);
        $perPage = $request->input('per_page') ?? self::PER_PAGE;

        $users = $query->paginate((int)$perPage);

        return UserResource::collection($users);
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json([
                'message' => 'User deleted successufully',
                'status_code' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Some error, please try again',
                'status_code' => 500
            ], 500);
        }
    }

    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'adress' => 'required|min:3',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->adress = $request->adress;

        if ($user->save()) {
            return response()->json($user, 200);
        } else {
            return response()->json([
                'message' => 'Some error, please try again',
                'status_code' => 500
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'adress' => 'required|min:3',
        ]);
//        $user = new User();
        $user = User::find($request->id);

        $user->update($request->all());

        return response()->json('User updated!');

    }

    public function destroyAny($users)
    {
//        dd($users);
       $users = explode(',',$users);
        if (User::whereKey($users)->delete()) {
            return response()->json([
                'message' => 'Users deleted successufully',
                'status_code' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Some error, please try again',
                'status_code' => 500
            ], 500);
        }
    }
}
