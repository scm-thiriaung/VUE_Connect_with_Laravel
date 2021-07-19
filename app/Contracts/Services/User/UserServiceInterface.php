<?php

namespace App\Contracts\Services\User;

use Illuminate\Http\Request;
use App\Models\User;

interface UserServiceInterface
{
  public function insertUser(Request $request);
  public function insertUserUpdate(Request $request,string $email,string $id);
  public function updateUser(Request $request, user $user);
  public function updatePasswordByToken(Request $request);
  // public function showUserList(string $email,int $status);
  public function showUserList();
  public function showUserDetail(user $user);
  // public function searchUser(string $email,Request $request);
  public function searchUser(Request $request);
  public function getLoginUserID(Request $request);
  public function getUserDataByEmail(string $email);
  public function getTokenByEmail(string $user);
  public function DBUpdatePassword(Request $request, user $user);
}