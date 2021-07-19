<?php

namespace App\Dao\Post;

use Illuminate\Http\Request;
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use App\Imports\postImport;
use Session;
use DB;
use Excel;
use File;
use Auth;
use Cookie;

class postDao implements PostDaoInterface
{
    public function insertPost(Request $request){
        try{
            $data=$request;
            $post=new Post();
            $post->title=$data['title'];
            $post->description=$data['description'];
            $post->status=1;
            $post->created_user_id=$data['userID'];
            $post->updaed_user_id=$data['userID'];
            $post->save();
            return true;
        }catch(Exception $e){
            return false;
        } 
    }

    public function getPostData(){
        return DB::table('posts')
                ->select('posts.id','users.name','posts.title','posts.description')
                ->join('users','users.id','=','posts.created_user_id')->get();
    }

    public function getPostTitle(){
        return DB::table('posts')
                ->select('posts.title')
                ->get();
    }

    public function getPostDataDetail(post $post){
        return DB::table('posts')
                ->select('posts.id','users.name','posts.title','posts.description')
                ->join('users','users.id','=','posts.created_user_id')
                ->where('posts.id',$post->id)
                ->get();
    }

    public function updatePost(Request $request,post $post){
        try{
            $title=$request->input('title');
            $description=$request->input('description');
            $updated_at=now();
            DB::update('update posts set title=?,description=?,updated_at=? where id=?',[$title,$description,$updated_at,$post->id]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function searchPost(Request $request){
        $search = $request->search_data;
        return DB::table('posts')
                ->select('posts.id','users.name','posts.title','posts.description')
                ->join('users','users.id','=','posts.created_user_id')
                ->where('title','like','%'.$search.'%');
    }

    public function searchClientPost(Request $request){
        $search = $request->keyword;
        return DB::table('posts')
                ->select('posts.id','users.email','posts.title','posts.description')
                ->join('users','users.id','=','posts.created_user_id')
                ->where('posts.title','like','%'.$search.'%')
                ->get();
    }

    public function getExcelFileData(Request $request){
        return Excel::toArray(new PostImport,$request->file('file'));
    }
}