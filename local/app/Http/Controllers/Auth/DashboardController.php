<?php

namespace App\Http\Controllers\Auth;

use App\Fair;
use App\File;
use Auth;
use Cache;
use Carbon\Carbon;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use LaravelAnalytics;

class DashboardController extends Controller
{

    /**
     * @param Request $request
     * @param null $year
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $year = null){
        $user = Auth::user();
        if ($year == null){
            if(session('year') != null){
                $fair = Fair::where('year', session('year'))->first();
            }else{
                $fair = Fair::orderBy('year', 'desc')->first();
                $request->session()->put('year', $fair->year);
            }
        }else{
            $fair = Fair::where('year', $year)->first();
            $request->session()->put('year', $year);
        }
        $fairs = Fair::orderBy('year', 'desc')->get();
        $setting = json_decode($fair->value);

        $view2 = LaravelAnalytics::getVisitorsAndPageViews(7);
        $view1 = LaravelAnalytics::performQuery(Carbon::now('Asia/Taipei')->subday(8),Carbon::now('Asia/Taipei')->subday(1),'ga:pageviews', [
            'dimensions' => 'ga:date',
            'filters'    => 'ga:eventAction=='.session('year')]); // 抓當年度的view

        // 檔案上傳
        $files = File::where('type', 'application/pdf')
            ->orwhere('type','application/msword') //.doc
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') //.docx
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') //.xlsx
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.presentationml.presentation') //.pptx
            ->orwhere('type', 'application/vnd.ms-powerpoint') //.ppt
            ->orwhere('type', 'application/vnd.ms-excel')//.xls
            ->paginate(30);

        return view('auth.dashboard', compact('user', 'fairs', 'fair','setting','view1', 'files'));
    }

    public function cache(){
        Cache::flush();
        $success = '成功清除網站快取';
        return redirect()->route('index')->withSuccess($success);
    }


}
