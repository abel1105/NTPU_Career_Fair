<?php

namespace App\Http\Controllers\Auth;

use App\Fair;
use App\Partner;
use Cache;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year)
    {
        $id = Fair::NowId();
        $partner = Partner::where('fair_id', $id)->paginate(10);
        return view('auth.partner', compact('partner'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.partner_create');
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
        $store = Partner::create(['company'=>$request['company'],'img' => $request['img'],'link'=> $request['link'],'fair_id' => $request['fair_id'] ]);

        if($store) {
            $success = "成功新增 " . $request['company'] . ' 連結';
            return redirect()->route('partner', session('year'))->withSuccess($success);
        }else{
            $error = '失敗';
            return view('auth.partner', compact('lectures','error'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Partner::where('id', $id )->first();

        return view('auth.partner_edit',compact('link'));
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
        $link = Partner::where('id', $id )->update(['company'=>$request['company'],'img'=>$request['img'],'link'=>$request['link'],'fair_id' => $request['fair_id']]);

        if($link){
            $success = "成功更新 " . $request['company'] . ' 職缺';
            Cache::forget('partners_'.session('year'));
            return redirect()->route('partner', session('year'))->withSuccess($success);
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
        $request = Request::all();
        $delete = Partner::where('id', $id)->delete();
        if($delete){
            $response = array(
                'status' => 'success',
                'msg' => '成功刪除 '.$request['company'].' 職缺',
            );
            Cache::forget('partners_'.session('year'));
        }else{
            $response = array(
                'status' => 'error',
                'msg' => '刪除失敗',
            );
        }
        return response()->json( $response );
    }

    public function status($id)
    {
        $partner = Partner::where('id', $id)->first();
        if( $partner['active'] == '0')
        {
            Partner::Where('id', $id)->update(['active'=>'1']);
            $status = 'active';
        }elseif( $partner['active'] == '1' ){
            Partner::Where('id', $id)->update(['active'=>'0']);
            $status = 'inactive';
        }else{
            return Response::json(['status' =>'error']);
        }
        Cache::forget('partners_'.session('year'));
        return Response::json(['status' => $status]);
    }
}
