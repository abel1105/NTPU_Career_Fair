<?php

namespace App\Http\Controllers\Auth;

use App\File;
use DB;
use Request;
use App\Http\Controllers\Controller;
use Input;
use Response;
use Validator;
use Carbon\Carbon;
use URL;
use Auth;

class FileController extends Controller
{
    public function index()
    {
        $files = File::latest('updated_at')->paginate(48);
        if (Request::wantsJson()){
            return response()->json($files);
        }else{
            return view('auth.file', compact('files'));
        }
    }
    public function image()
    {
        $files = File::where('type', 'image/png')->orwhere('type','image/gif')->orwhere('type','image/jpeg')->latest('updated_at')->paginate(48);
        if (Request::wantsJson()){
            return response()->json($files);
        }else{
            return view('auth.file', compact('files'));
        }
    }
    public function images($start)
    {
        $files = File::where('type', 'image/png')
            ->orwhere('type','image/gif')
            ->orwhere('type','image/jpeg')
            ->latest('updated_at')
            ->skip($start)->take(2)->get();
        return Response::json(['files'=> $files], 200);
    }
    public function doc()
    {
        $files = File::where('type', 'application/pdf')
            ->orwhere('type','application/msword') //.doc
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') //.docx
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') //.xlsx
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.presentationml.presentation') //.pptx
            ->orwhere('type', 'application/vnd.ms-powerpoint') //.ppt
            ->orwhere('type', 'application/vnd.ms-excel')//.xls
            ->paginate(48);
        if (Request::wantsJson()){
            return response()->json($files);
        }else{
            return view('auth.file', compact('files'));
        }    }
    public function docs($start)
    {
        $files = File::where('type', 'application/pdf')
            ->orwhere('type','application/msword') //.doc
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') //.docx
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') //.xlsx
            ->orwhere('type', 'application/vnd.openxmlformats-officedocument.presentationml.presentation') //.pptx
            ->orwhere('type', 'application/vnd.ms-powerpoint') //.ppt
            ->orwhere('type', 'application/vnd.ms-excel')//.xls
            ->latest('updated_at')
            ->skip($start)->take(2)->get();
        return Response::json(['files'=> $files], 200);
    }
    public function other()
    {
        $files = File::whereNotIn('type', [
            'image/png', 'image/gif', 'image/jpeg',
            'application/pdf','application/msword','application/vnd.ms-excel','application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ])->latest('updated_at')->paginate(48);
        if (Request::wantsJson()){
            return response()->json($files);
        }else{
            return view('auth.file', compact('files'));
        }    }
    public function search()
    {
        $input = Input::all()['search'];
        $files = DB::table('files')->where('name', 'LIKE', '%'.$input.'%')->latest('updated_at')->paginate(48);
        if (Request::wantsJson()){
            return response()->json($files);
        }else{
            return view('auth.file', compact('files'));
        }    }
    public function uploadMultiple()
    {
        $user = Auth::user();
        $inputs = Input::file('file');
        $rules = array(
            'file' => 'max:2048',
        );
        $file_count = count($inputs);
        $upload_count = 0;
        $output = [];
        foreach($inputs as $input)
        {
            $validation = Validator::make($inputs, $rules);
            if($validation->passes()){

                $file = $input;
                $mime = $file->getMimeType();
                $time = Carbon::now();
                $extension = $file->getClientOriginalExtension();
                $fileOriginalName = $this->handleFileName(mb_convert_encoding(preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName()), "UTF-8"));
                $directory = 'uploads/' . $time->__get('year') . '/' . $time->__get('month');

                if (file_exists($directory . '/' . $fileOriginalName . ".{$extension}")) {
                    // 跑迴圈 去檢查現在檔案名稱有沒有重複，重複編號就+1
                    for ($i = 1; ; $i++) {
                        if (!file_exists($directory . '/' . $fileOriginalName . "-" . $i . ".{$extension}")) {
                            break;
                        }
                    }
                    $filename = $fileOriginalName . "-" . $i . ".{$extension}";
                    $fileOriginalName = $fileOriginalName . "-" . $i ;
                } else {
                    $filename = $fileOriginalName . ".{$extension}";
                }

                $file->move($directory, $filename);
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    $fileOriginalName = mb_convert_encoding($fileOriginalName, 'UTF-8', "big5");
                    $filename = mb_convert_encoding($filename, 'UTF-8', "big5");
                }
                $url = URL::to('/').'/'.$directory.'/'.$filename;
                File::create(['name'=>$fileOriginalName, 'type' => $mime, 'url' => $url, 'author' => $user->name ]);
                $isImg = substr($mime,0,5) == 'image' ? true : false;
                array_push($output, ['id'=> File::where('name',$fileOriginalName)->first()->id, 'name'=> $fileOriginalName, 'url' => $url, 'author'=> $user->name, 'isImage'=> $isImg]);
                $upload_count++;
            }
        }
        if($upload_count == $file_count)
        {
            return Response::json(['status'=> 'success', 'file'=> $output], 200);
        }else {
            return Response::make($validation->errors()->first(), 400);
        }
    }
    public function upload()
    {
        $user = Auth::user();
        $input = Input::all();
        $rules = array(
            'file' => 'max:2048|required|mimes:png,gif,jpeg,txt,pdf,doc',
        );
        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors()->first(), 400);
        }

        $file = Input::file('file');
        $mime = $file->getMimeType();

        $time = Carbon::now();
        $extension = $file->getClientOriginalExtension();
        $fileOriginalName = $this->handleFileName(preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName()));
        $directory = 'uploads/' . $time->__get('year') . '/' . $time->__get('month');

        if (file_exists($directory . '/' . $fileOriginalName . ".{$extension}")) {
            // 跑迴圈 去檢查現在檔案名稱有沒有重複，重複編號就+1
            for ($i = 1; ; $i++) {
                if (!file_exists($directory . '/' . $fileOriginalName . "-" . $i . ".{$extension}")) {
                    break;
                }
            }
            $filename = $fileOriginalName . "-" . $i . ".{$extension}";
            $fileOriginalName = $fileOriginalName . "-" . $i ;
        } else {
            $filename = $fileOriginalName . ".{$extension}";
        }

        $upload_success = $file->move($directory, $filename);
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $fileOriginalName = mb_convert_encoding($fileOriginalName, 'UTF-8', "big5");
            $filename = mb_convert_encoding($filename, 'UTF-8', "big5");
        }
        $url = URL::to('/').'/'.$directory.'/'.$filename;
        File::create(['name'=>$fileOriginalName, 'type' => $mime, 'url' => $url, 'author' => $user->name ]);

        if ($upload_success) {
            return Response::json(['url'=> $url, 'name'=>$fileOriginalName], 200);
        } else {
            return Response::json('error', 400);
        }
    }
    public function destroy(Request $request){

        $idArray = $request::all()['id'];
        foreach($idArray as $value){

            unlink($this->handleFileName(explode('/career/' ,File::where('id', $value)->first()->url)[1],true));
        }
        $delete = File::destroy($idArray);
        if($delete){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }

    private function handleFileName($name, $delete = false){
        if($delete == false){
            $name = str_replace('/', '_', $name);
            $name = str_replace('\\', '_', $name);
            $name = str_replace('.', '_', $name);
            $name = str_replace(':', '_', $name);
            $name = str_replace(' ', '_', $name);
        }
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $name = mb_convert_encoding($name,"big5");
        }
        return $name;
    }
}
