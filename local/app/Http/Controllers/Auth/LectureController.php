<?php

namespace App\Http\Controllers\Auth;

use App\Fair;
use App\Lecture;
use App\LectureCat;
use Cache;
use Illuminate\Routing\Route;
use Redirect;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year)
    {
        $fair = Fair::where('year', $year)->first();

        $lectures = Lecture::where('fair_id', $fair['id'] )->orderBy('updated_at','DESC')->paginate(10);

        return view('auth.lecture', compact('lectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = LectureCat::get();
        return view('auth.lecture_create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $fairId = Fair::nowid();

        $request = Request::all();
        $updatetime = $request['date'].' '.$request['start'].':00';
        $store = Lecture::create(['title'=>$request['title'],'date' => $request['date'],'start' => $request['start'],'end' => $request['end'],'place' => $request['place'], 'info'=>$request['info'],'created_at'=> $updatetime,'fair_id'=> $request['fair_id'],'type'=> $request['type'] ]);

        $lectures = Lecture::where('fair_id', $fairId )->latest('updated_at')->paginate(10);

        if($store) {
            Cache::forget('lectures_'. $request['year']);
            $success = "成功新增 " . $request['title'] . ' 活動';
            return Redirect::route('lecture', array(session('year')))->withSuccess($success);
        }else{
            $error = '失敗';
            return Redirect::route('lecture', array(session('year')))->withErrors($error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($year, $id)
    {

        $lecture = Lecture::where('id', $id )->first();
        $category = LectureCat::get();

        return view('auth.lecture_edit',compact('lecture', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($year, $id)
    {
        $fair = Fair::where('year', $year)->first();
        $lectures = Lecture::where('fair_id', $fair['id'] )->latest('updated_at')->paginate(10);
        $request = Request::all();
        $updatetime = $request['date'].' '.$request['start'].':00';
        $update = Lecture::where('id', $id)->update(['title'=>$request['title'],'date' => $request['date'],'start' => $request['start'],'end' => $request['end'],'place' => $request['place'], 'info'=>$request['info'],'type'=> $request['type'],'created_at'=> $updatetime ]);
        if($update) {
            Cache::forget('lectures_'. $year);
            $success = "成功修改" . $request['title'] . '活動';
            return Redirect::route('lecture', array(session('year')))->withSuccess($success);
        }else{
            $error = '失敗';
            return Redirect::route('lecture', array(session('year')))->withErrors($error);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $request = Request::all();

        $delete = Lecture::where('id', $request['id'])->delete();

        if($delete){
            Cache::forget('lectures_'.session('year'));
            $response = array(
                'status' => 'success',
                'msg' => '成功刪除編號'.$request['id'].'公告',
            );
        }else{
            $response = array(
                'status' => 'error',
                'msg' => '刪除失敗',
            );
        }
        return Response::json( $response );
    }

    public function order($year, $type)
    {
        switch($type){
            case 'dateDESC':
                $fair = Fair::where('year', $year)->first();

                $lectures = Lecture::where('fair_id', $fair['id'] )->orderBy('date','desc')->paginate(10);

                return view('auth.lecture', compact('lectures','type'));
            case 'updateDESC':
                $fair = Fair::where('year', session('year'))->first();

                $lectures = Lecture::where('fair_id', $fair['id'] )->orderBy('updated_at','desc')->paginate(10);

                return view('auth.lecture', compact('lectures','type'));
            case 'dateASC':
                $fair = Fair::where('year', session('year'))->first();

                $lectures = Lecture::where('fair_id', $fair['id'] )->orderBy('date','asc')->paginate(10);

                return view('auth.lecture', compact('lectures','type'));
            case 'updateASC':
                $fair = Fair::where('year', session('year'))->first();

                $lectures = Lecture::where('fair_id', $fair['id'] )->orderBy('updated_at','asc')->paginate(10);

                return view('auth.lecture', compact('lectures','type' ));
        }
    }
}
