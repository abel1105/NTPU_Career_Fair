<?php

namespace App\Http\Controllers;

use App;
use App\Fair;
use App\Lecture;
use App\Link;
use App\Partner;
use App\Post;
use Carbon\Carbon;
use Date;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use Redirect;
Date::setLocale('zh_TW');

class FairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year = null)
    {
        if($year == null){
            if(Cache::has('fair')){
                $fair = Cache::get('fair');
            }else{
                $fair = Fair::where('active', '1')->latest('year')->first();
                if(!$fair){
                    App::abort(404); //如果還沒active就404
                }
                Cache::forever('fair', $fair);
            }
            $year = $fair->year;
        }else{
            if(Cache::has('fair_'.$year)){
                $fair = Cache::get('fair_'.$year);
            }else{
                $fair = Fair::where('active', '1')->where('year', $year)->first();
                if(!$fair){
                    App::abort(404); //如果還沒active就404
                }
                Cache::forever('fair_'.$year, $fair);
            }
        }
        // 最新訊息 Cache
        if(Cache::has('posts_'.$year)){
            $posts = Cache::get('posts_'.$year);
        }else {
            $posts = Post::where('fair_id', $fair->id)->where('post_status', '1')->latest('created_at')->get();
            Cache::forever('posts_'.$year, $posts);
        }
        //網站頁面設計 json
        $setting = json_decode($fair->value);
        //網站相連結 link Cache
        if(Cache::has('links')){
            $links = Cache::get('links');
        }else{
            $links = Link::all();
            Cache::forever('links', $links);
        }
        //網站職缺 Partner Cache
        if(Cache::has('partners_'.$year)){
            $partners = Cache::get('partners_'.$year);
        }else{
            $partners = Partner::where('fair_id', $fair->id)->where('active', 1)->latest('updated_at')->get();
            Cache::forever('partners_'.$year, $partners);
        }
        if(Cache::has('lectures_'.$year)) {
            $lectures = Cache::get('lectures_'.$year);
        }else{
            $lectures = Lecture::where('fair_id', $fair->id)->where('date', '>=', Carbon::today())->where('date', '<', Carbon::today()->addMonth(2))->orderBy('date', 'ASC')->paginate(6);
            Cache::put('lectures_'.$year, $lectures, 60);
        }

        return view('fair', compact('fair','posts', 'setting','links','partners','lectures'));
    }

    public function lecturebytype(Request $request,$year, $type)
    {
        if(Cache::has('fair_'.$year)){
            $fair = Cache::get('fair_'.$year);
        }else{
            $fair = Fair::where('active', '1')->where('year', $year)->first();
            if(!$fair){
                App::abort(404); //如果還沒active就404
            }
            Cache::forever('fair_'.$year, $fair);
        }
        if(Cache::has('lectures_'.$year.'_'.$type.'_'.$request->page)) {
            $data = Cache::get('lectures_'.$year.'_'.$type.'_'.$request->page);
        }else {
            switch ($type) {
                case 'recent':
                    $lectures = Lecture::where('fair_id', $fair->id)->where('date', '>=', Carbon::today())->where('date', '<', Carbon::now()->addMonth(1))->orderBy('date', 'ASC')->paginate(6);
                    break;
                case 'today':
                    $lectures = Lecture::where('fair_id', $fair->id)->where('date', '=', Carbon::today())->orderBy('date', 'ASC')->paginate(6);
                    break;
                case 'tomorrow':
                    $lectures = Lecture::where('fair_id', $fair->id)->where('date', '=', Carbon::tomorrow())->orderBy('date', 'ASC')->paginate(6);
                    break;
                case 'week':
                    $lectures = Lecture::where('fair_id', $fair->id)->where('date', '>', Carbon::yesterday())->where('date', '<', Carbon::today()->endOfWeek())->orderBy('date', 'ASC')->paginate(6);
                    break;
            }
            $data = array();
            foreach($lectures as $value){
                array_push($data, ['id'=> $value->id,'category'=>$value->category->title,'fontawesome'=>$value->category->fontawesome,'color' => $value->category->color,'start'=> $value->start, 'end'=> $value->end,'place'=> $value->place,'date'=> $value->date,'showdate'=> str_replace('星期','',Date::parse($value->date)->format('m/d (D)')), 'title'=> $value->title ,'info'=> $value->info]);
            }
            Cache::put('lectures_'.$year.'_'.$type.'_'.$request->page, $data, 60);
        }
        return response()->json($data);

    }

    public function lecturebyyear($year){
        if(Cache::has('fair_'.$year)){
            $fair = Cache::get('fair_'.$year);
        }else{
            $fair = Fair::where('active', '1')->where('year', $year)->first();
            if(!$fair){
                App::abort(404); //如果還沒active就404
            }
            Cache::forever('fair_'.$year, $fair);
        }
        $request = Request::all();
        if(Cache::has('lectures_'.$fair->id.'_'.$request['year'].'_'.$request['month'])){
            $lectuers = Cache::get('lectures_'.$fair->id.'_'.$request['year'].'_'.$request['month']);
        }else{
            $lectuers = Lecture::where('fair_id', $fair->id)->where('date', 'LIKE', $request['year'].'-'.$request['month'].'%')->orderBy('created_at', 'ASC')->get();
        }
        $data = array();
        foreach($lectuers as $value){
            array_push($data, ['id'=> $value->id,'start'=> $value->start, 'end'=> $value->end,'place'=> $value->place,'date'=> $value->date,'showdate'=> Carbon::parse($value->date)->format('d'), 'title'=> $value->title ,'body'=> $value->info]);
        }
        return response()->json($data);
    }
}
