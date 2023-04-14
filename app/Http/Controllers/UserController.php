<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = $request->user();
        $nickName = $request->input('nickName');
        $avatar= $request->input('avatar');
        $result = (new User) -> updateUser($user['id'],$nickName, $avatar);
        return response()->json($result);

    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        $result = (new User) -> getUser($user['id']);
        return response()->json($result);
    }
}
