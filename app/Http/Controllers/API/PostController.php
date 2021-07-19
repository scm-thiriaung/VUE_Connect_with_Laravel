<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\postExport;
use App\Imports\postImport;
use App\Models\Post;
use App\Models\User;
use Session;
use Auth;
use DB;
use Excel;
use File;
use Config;
use Log;

class PostController extends Controller
{
    protected $postServiceInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }

    public function postList(Request $request){
        $posts = DB::table('posts')
                ->select('posts.id','users.name','posts.title','posts.description')
                ->join('users','users.id','=','posts.created_user_id')->get();
        return json_encode($posts);
    }

    public function store(Request $request)
    {
        $check=$this->postServiceInterface->insertPost($request);
        if($check) {
             return response()->json('New Post Created');
         }
         else {
             return response()->json('New Post Creation Fail!!!');
         }
        //return response()->json($request->userID);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update($id,Request $request)
    {
        $post = Post::find($id);
        $post->update($request->all());
        //return response()->json($request->all());
        return response()->json('Post updated!');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json('Post deleted!');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new PostExport(), 'post.xlsx');
    }

    public function importExcel(Request $request) 
    {
        Excel::import(new PostImport, $request->file('import_file'));
        return response()->json('File uploaded  successfully!!');
    }

    /**
     * Searching the post with post title.
     * 
     * @param Request $request (Request post title data from user)
    */
    public function findPost(Request $request)
    {
        $posts=$this->postServiceInterface->searchPost($request);
        //return json_encode($posts);	
        return json_encode($posts);	
    }
}
