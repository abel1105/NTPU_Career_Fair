<?php

namespace App\Http\Controllers\Auth;

use App\Link;
use Cache;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::paginate(10);
        return view('auth.link', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.link_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $request = Request::all();
        $store = Link::create(['name'=>$request['name'],'img' => $request['img'],'link'=> $request['link'] ]);

        if($store) {
            $success = "成功新增 " . $request['name'] . ' 連結';
            return redirect()->route('link')->withSuccess($success);
        }else{
            $error = '失敗';
            return view('auth.lecture', compact('lectures','error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = Link::where('id', $id)->delete();

        if($delete){
            $response = array(
                'status' => 'success',
                'msg' => '成功刪除編號'.$id.'連結',
            );
            Cache::forget('links');
        }else{
            $response = array(
                'status' => 'error',
                'msg' => '刪除失敗',
            );
        }
        return Response::json( $response );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::where('id', $id )->first();

        return view('auth.link_edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $request = Request::all();
        $link = Link::where('id', $id )->update(['name'=>$request['name'],'img'=>$request['img'],'link'=>$request['link']]);

        if($link){
            $success = "成功更新 " . $request['name'] . ' 連結';
            Cache::forget('links');
            return redirect()->route('link')->withSuccess($success);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Link::where('id', $id)->delete();
        if($delete){
            $response = array(
                'status' => 'success',
                'msg' => '成功刪除此連結',
            );
            Cache::forget('links');
        }else{
            $response = array(
                'status' => 'error',
                'msg' => '刪除失敗',
            );
        }
        return Response::json( $response );
    }
}
