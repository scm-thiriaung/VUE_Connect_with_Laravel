<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Rules\IsValidPassword;
use App\Contracts\Services\User\UserServiceInterface;
use App\Models\Post;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use Config;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $userServiceInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userServiceInterface = $userServiceInterface;
    }
    
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $email=$request->email;
            $success = true;
            $message = 'User login successfully';
            $userInfo = Auth::user();
        } else {
            $success = false;
            $message = 'Unauthorised';
        }
        // response
        $response = [
            'success' => $success,
            'message' => $message,
            'user' => $userInfo,
        ];
        return response()->json($response);
    }
    
    /**
     * Logout
    */
    public function logout(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user()->currentAccessToken()->delete();
            $success = true;
            $message = 'Successfully logged out';
        }
        // response
        $response = [
            'success' => true,
            'message' => 'Successfully logged out',
        ];
        return response()->json($response);
    }

    public function userList(Request $request){
        $users = $this->userServiceInterface->showUserList();
        return json_encode($users);
    }

    public function store(Request $request)
    {
        $check=$this->userServiceInterface->insertUser($request);
        if($check) {
           return response()->json('New User Created');
        }
        else {
           return response()->json('New User Creation Fail!!!');
        }
        //return response()->json($request->all());
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('User deleted!');
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update($id,Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());
        //return response()->json($request->all());
        return response()->json('User updated!');
    }

    public function userSearch(Request $request){
        $users=$this->userServiceInterface->searchUser($request);
        return json_encode($users);
    }
}
