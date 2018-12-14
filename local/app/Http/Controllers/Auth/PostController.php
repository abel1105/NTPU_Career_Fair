<?php

namespace App\Http\Controllers\Auth;

use App\Fair;
use App\Post;
use Cache;
use Redirect;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class PostController extends Controller
{
    public function index($year)
    {
        $fair = Fair::where('year', $year)->first();

        $posts = Post::where('fair_id', $fair['id'] )->orderBy('updated_at','DESC')->paginate(10);

        return view('auth.post',compact('posts', 'fair'));
    }
    public function edit($year, $id)
    {
        $fair = Fair::where('year', $year)->first();

        $post = Post::where('id', $id )->first();

        return view('auth.post_edit',compact('post','fair'));
    }
    public function update($year, $id)
    {
        $request = Request::all();
        $update = Post::where('id', $id)->update(['title'=>$request['title'], 'content'=>$request['content'] ]);
        $fair = Fair::where('year', $year)->first();
        $posts = Post::where('fair_id', $fair['id'] )->latest('updated_at')->paginate(10);
        if($update) {
            $success = "成功修改" . $request['title'] . '公告';
            Cache::forget('posts_'.session('year'));
            return Redirect::route('post', array(session('year')))->withSuccess($success);
        }else{
            $error = '失敗';
            return Redirect::route('post', array(session('year')))->withErrors($error);
        }

    }

    public function create($year)
    {
        $fair = Fair::where('year', $year)->first();
        return view('auth.post_create', compact('fair','year'));
    }
    public function store($year)
    {
        $request = Request::all();
        $store = Post::create($request);

        $fair = Fair::where('year', $year)->first();
        $posts = Post::where('fair_id', $fair['id'] )->latest('updated_at')->paginate(10);
        if($store) {
            $success = "成功新增" . $request['title'] . '公告';
            Cache::forget('posts_'.session('year'));
            return Redirect::route('post', array(session('year')))->withSuccess($success);
        }else{
            $error = '失敗';
            return Redirect::route('post', array(session('year')))->withErrors($error);
        }

    }
    public function delete($id)
    {
        $request = Request::all();

        $delete = Post::where('id', $request['id'])->delete();

        if($delete){
            $response = array(
                'status' => 'success',
                'msg' => '成功刪除編號'.$request['id'].'公告',
            );
            Cache::forget('posts_'.session('year'));
        }else{
            $response = array(
                'status' => 'error',
                'msg' => '刪除失敗',
            );
        }
        return Response::json( $response );
    }
    public function status($id)
    {
        $post = Post::where('id', $id)->first();
        if( $post['post_status'] == '0')
        {
            Post::Where('id', $id)->update(['post_status'=>'1']);
            $status = 'active';
        }elseif( $post['post_status'] == '1' ){
            Post::Where('id', $id)->update(['post_status'=>'0']);
            $status = 'inactive';
        }else{
            return Response::json(['status' =>'error']);
        }
        Cache::forget('posts_'.session('year'));
        return Response::json(['status' => $status]);
    }

}
