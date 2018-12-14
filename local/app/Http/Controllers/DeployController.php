<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeployController extends Controller
{
    public function index(Request $request){
        if(substr($request->header('User-Agent'), 0,15)=='GitHub-Hookshot'){
            $data = array(
                'LOCAL_ROOT'      => 'C:/TWAMPd/htdocs/career',
                'LOCAL_REPO_NAME' => 'NTPU-career',
                'LOCAL_REPO'      => 'C:/TWAMPd/htdocs/career',
                'REMOTE_REPO'     => 'git@github.com:kent62001/NTPU-career.git',
                'BRANCH'          => 'develop'
            );

            $OK = $this->doexec($data);
            return response()->json(array('success'=>$OK));
        }
        else{
            return App::abort(404);
        }
    }

    private function doexec($data){
        if( file_exists($data['LOCAL_REPO']) ) {
            return shell_exec("cd {$data['LOCAL_REPO']} && git pull origin {$data['BRANCH']} && php local/artisan view:clear && php local/artisan route:clear");
        } else {
            return shell_exec("cd {$data['LOCAL_ROOT']} && git clone {$data['REMOTE_REPO']}");
        }
    }

}
