<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::paginate(10);

        return response()->json($users, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:50',
           'email' => 'required|string|email|unique:users',
           'password' => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Bir Hata Oluştu',
                'errors' => $validator->errors()
            ], 422);
        }
        $data = $request->only('name', 'email', 'password');
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = new UserResource(User::find($id));

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
