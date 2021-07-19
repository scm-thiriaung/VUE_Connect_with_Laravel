<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use DB;
use Auth;
use Carbon\Carbon;

class userService implements UserServiceInterface
{
    private $userDao;

    /**
    * Class Constructor
    * @param OperatorUserDaoInterface
    * @return
    */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    public function insertUser(Request $request){
        return $this->userDao->insertUser($request);
    }

    public function insertUserUpdate(Request $request,string $email,string $id){
        return $this->userDao->insertUserUpdate($request,$email,$id);
    }

    public function updateUser(Request $request, user $user){
        return $this->userDao->updateUser($request,$user);
    }

    public function updatePasswordByToken(Request $request){
        return $this->userDao->updatePasswordByToken($request);
    }

    // public function showUserList(string $email,int $status){
    //     return $this->userDao->showUserList($email,$status);
    // }

    public function showUserList(){
        return $this->userDao->showUserList();
    }

    public function showUserDetail(user $user){
        return $this->userDao->showUserDetail($user);
    }

    // public function searchUser(string $email,Request $request){
    //     return $this->userDao->searchUser($email,$request);
    // }

    public function searchUser(Request $request){
        return $this->userDao->searchUser($request);
    }

    public function getLoginUserID(Request $request){
        return $this->userDao->getLoginUserID($request);
    }

    public function getUserDataByEmail(string $email){
        return $this->userDao->getUserDataByEmail($email);
    }

    public function getTokenByEmail(string $user){
        return $this->userDao->getTokenByEmail($user);
    }

    public function DBUpdatePassword(Request $request, user $user){
        return $this->userDao->DBUpdatePassword($request,$user);
    }
}