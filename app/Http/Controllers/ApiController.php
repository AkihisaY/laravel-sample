<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\library\Common;
use App\Models\Api;
use App\Models\Key;

class ApiController extends Controller
{
    /**
     * Open Top Page
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Open API Key ==');
            $user_id = $request->session()->get('user_id');
            $key_info = new Key();
            $keys = $key_info->getKeyList($user_id);
            // dd($assets);
            return view('api.index',['keys'=>$keys]);
        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }
    }

    /**
     * Create API Key
     * 
     * @param sRequest $request
     * @return json 
     */
    public function create(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info('== Create API Key Start ==');
            $user_id = $request->session()->get('user_id');
            $project_name = $request->project_name;
            $key_info = new Key();
            $status = $key_info->insertProjectKey($user_id,$project_name);
            // dd($assets);
            return response()->json(['status'=>$status]);

        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * Delete API Key
     * 
     * @param sRequest $request
     * @return json 
     */
    public function delete(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info('== Delete API Key Start ==');
            $user_id = $request->session()->get('user_id');
            $key_id = $request->key_id;
            $key_info = new Key();
            Log::debug($request->session()->get('user_name').' : Key :'.$key_id.', user_id:'.$user_id);
            $status = $key_info->deleteProjectKey($user_id,$key_id);
            return response()->json(['status'=>$status]);

        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * Recover API Key
     * 
     * @param sRequest $request
     * @return json 
     */
    public function recover(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info('== recover API Key Start ==');
            $user_id = $request->session()->get('user_id');
            $key_id = $request->key_id;
            $key_info = new Key();
            Log::debug($request->session()->get('user_name').' : Key :'.$key_id.', user_id:'.$user_id);
            $status = $key_info->recoverProjectKey($user_id,$key_id);
            // dd($assets);
            return response()->json(['status'=>$status]);

        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * Get Api Data
     * 
     * @param sRequest $request
     * @return json 
     */
    public function getApi(Request $request){
        Log::info('== Get API Data Start ==');
        $user_id = $request->user_id;
        $project_key = $request->key;
        $key_info = new Key();
        Log::debug(' User ID :'.$user_id.', Project_ Key:'.$project_key);
        if($key_info->isValidKey($user_id,$project_key)){
            $api_info = new Api();
            $ret_arr = null;
            if($request->function == 'monthly_asset'){                
                $ret_arr = $api_info->getMonthlyAsset($request->month);
            }elseif($request->function == 'total_asset'){
                $ret_arr = $api_info->getTotalAsset();
            }elseif($request->function == 'expense_list'){
                $ret_arr = $api_info->getExpenseList();
            }
            $status = true;
            if(!isset($ret_arr)){
                $status = false;
            }
            return response()->json(['status'=>$status,'result'=>$ret_arr]);

        }else{
            Log::debug($user_id.' : Project key or User ID are not valid.');
            return response()->json(['status'=>false,'result'=>null]);
        }        
    }

    /**
     * Get total API from api.php
     * 
     * @param sRequest $request
     * @return json 
     */
    public function api_total(Request $request){
        $api_info = new Api();
        $ret_arr = $api_info->getTotalAsset();
        $status = true;
        if(!isset($ret_arr)){
            $status = false;
        }
        return response()->json(['status'=>$status,'result'=>$ret_arr]);


    }
}
