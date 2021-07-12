<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\library\Common;
use App\Models\Key;

class DocumentController extends Controller
{
    /**
     * Open Document Page
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Open Document Page ==');
            return view('document.index');
        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }
    }

}
