<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\UploadTrait;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, UploadTrait;

    protected function getGuard()
    {
        if(Auth::guard('doctor')->check()){
            return "doctor";
        }else if(Auth::guard('pharmacist')->check()){
            return "pharmacist";
        }else if(Auth::guard('nurse')->check()){
            return "nurse";
        }else{
            return "web";
        }
    }
}
