<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;
use App\Imports\postImport;
use App\Models\Post;
use Session;
use DB;
use Excel;
use File;
use Auth;

class postService implements PostServiceInterface
{
    private $postDao;
    /**
    * Class Constructor
    * @param OperatorPostDaoInterface
    * @return
    */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    public function insertPost(Request $request){
        return $this->postDao->insertPost($request);
    }

    public function getPostData(){
        return $this->postDao->getPostData();
    }

    public function getPostTitle(){
        return $this->postDao->getPostTitle();
    }

    public function getPostDataDetail(post $post){
        return $this->postDao->getPostDataDetail($post);
    }

    public function updatePost(Request $request,post $post){
        return $this->postDao->updatePost($request,$post);
    }

    public function searchPost(Request $request){
        return $this->postDao->searchPost($request);
    }

    public function searchClientPost(Request $request){
        return $this->postDao->searchClientPost($request);
    }

    public function getExcelFileData(Request $request){
        return $this->postDao->getExcelFileData($request);
    }
}