<?php

namespace App\Http\Controllers\Auth;

use App\Fair;
use Auth;
use Cache;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FairController extends Controller
{
    public function index($year = null ){
        if ($year == null){
            $fair = Fair::orderBy('year', 'desc')->first();
        }else{
            $fair = Fair::where('year', $year)->first();
        }
        $fairs = Fair::orderBy('year', 'desc')->get();
        return view('auth.fair_create',compact('fair','fairs'));
    }

    public function store(Request $request){
        $request = $request->all();
        if ( ! Fair::where('year', $request['year'])->get()->isEmpty() ){
            $same = Fair::where('year', $request['year'])->first();
            $error = '已經存在 '.$same['year'].' 年度的就業博覽會：'.$same['name'];
            return view('auth.fair_create',compact('error'));
        }
        // 加入 json 設定檔
        $addition_type_final = [];
        $addition_type_list = ['img1_input', 'img1_anim', 'img2_input', 'img3_input', 'slogan', 'doc1_name', 'doc2_name', 'doc1_url', 'doc2_url'];
        foreach ($addition_type_list as $addition_type){
            $addition_type_final[$addition_type] = '';
        }
        $request['value'] = collect($addition_type_final)->toJson();
        Fair::create($request);
        $fair = Fair::where('year', $request['year'])->first();
        $fairs = Fair::orderBy('year', 'desc')->get();
        $success = "成功創建".$request['year'].'年度的就業博覽會：'.$request['name'];
        Cache::forget('fair');
        return view('auth.fair_create',compact('success','fairs','fair'));
    }
    public function update(Request $request){
        $request = $request->all();
        Fair::where('year',$request['year'] )->update(array('name'=>$request['name'], 'logo' => $request['logo']));
        $fair = Fair::where('year', $request['year'])->first();
        $fairs = Fair::orderBy('year', 'desc')->get();
        $success = "成功修改".$request['year'].'年度的就業博覽會';
        Cache::forget('fair');
        Cache::forget('fair_'.$request['year']);
        return view('auth.fair_create',compact('success','fair','fairs'));
    }
    public function set(Request $request)
    {
        $addition_type_final = [];
        $addition_type_list = ['img1_input', 'img1_anim', 'img2_input', 'img3_input', 'slogan', 'doc1_name', 'doc2_name', 'doc1_url', 'doc2_url'];
        foreach ($addition_type_list as $addition_type){
            $addition_type_final[$addition_type] = $request->exists($addition_type) ? $request->get($addition_type) : '';
        }
        Fair::where('id', $request->id )->update(array('value'=>collect($addition_type_final)->toJson()));
        $success = "成功修改".$request->year.'年度的就業博覽會';
        Cache::forget('fair');
        Cache::forget('fair_'.$request->year);
        return redirect()->route('index')->withSuccess($success);
    }
    public function active($year)
    {
        $fair = Fair::where('year', $year)->first();
        if($fair->active == 1){
            Fair::where('year', $year)->update(array('active'=>'0'));
            $success="成功設定為隱藏";
        }else {
            Fair::where('year', $year)->update(array('active'=>'1'));
            $success="成功設定為上線";
        }
        Cache::forget('fair');
        Cache::forget('fair_'.$year);
        return redirect()->route('index')->withSuccess($success);
    }
}
