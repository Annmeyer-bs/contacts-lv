<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DestroyUsersRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{


    public function index(UsersRequest $request)
    {
        $sortField = $request->get('sort_field');
        $sortOrder = $request->get('sort_order');
        $perPage = $request->get('per_page');

        $query = User::orderBY($sortField, $sortOrder);
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

    public function create(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->adress = $request->get('adress');

        if ($user->save()) {
            return response()->json($user, 200);
        } else {
            return response()->json([
                'message' => 'Some error, please try again',
                'status_code' => 500
            ], 500);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::find($request->id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->adress = $request->get('adress');

        $user->update($request->all());

        return response()->json('User updated!');
    }

    public function destroyBatch($ids)
    {
        $ids = explode(',',$ids);
        if (User::whereIn('id', $ids)->delete()) {
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
