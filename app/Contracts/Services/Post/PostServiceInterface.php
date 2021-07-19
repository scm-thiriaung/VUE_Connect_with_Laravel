<?php

namespace App\Contracts\Services\Post;

use Illuminate\Http\Request;
use App\Models\Post;

interface PostServiceInterface
{
  public function insertPost(Request $request);
  //get post list
  public function getPostData();
  public function getPostTitle();
  public function getPostDataDetail(post $post);
  public function updatePost(Request $request,post $post);
  public function searchPost(Request $request);
  public function searchClientPost(Request $request);
  public function getExcelFileData(Request $request);
}