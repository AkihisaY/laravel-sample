<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Asset;
use App\Models\Rate;
use App\Http\Requests\AssetRequest;

class TopController extends Controller
{
    /**
     * Open Top Page
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Open Top Page ==');

            $asset_info = new Asset();
            $assets = $asset_info->getAssetList();
            return view('top.index',['assets'=>$assets]);

        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }

    }

    /**
     * Get Stock Data information
     * 
     * @param sRequest $request
     * @return json 
     */
    public function stocks(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info('== Get Asset Category Data Start ==');

            $asset_info = new Asset();
            $assets = $asset_info->getCategoryAssetMonth();
            $status = true;
            if(!isset($assets)){
                $status = false;
            }
            return response()->json(['status'=>$status,'assets'=>$assets]);

        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * Get Asset Information
     * 
     * @param sRequest $request
     * @return json 
     */
    public function totalAsset(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info('== Get Stock Data Start ==');

            $asset_info = new Asset();
            $assets = $asset_info->getCategoryStackedAsset();
            $status = true;
            if(!isset($assets)){
                $status = false;
            }
            return response()->json(['status'=>$status,'assets'=>$assets]);

        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * Open Create Page
     * 
     * @param Request $request
     * @return view 
     */
    public function create(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info('== Create Asset Data ==');
            return view('top.add');

        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * insert data
     * 
     * @param Request $request
     * @return view 
     */
    public function insert(AssetRequest $request){
        Log::info('== Create Asset Data ==');
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Create Asset&Rate Data ==');
            $arr_data = array(
                $request->date_name
                ,$request->cash_jpy_name
                ,$request->cash_dol_name
                ,$request->inv_jpy_name
                ,$request->inv_dol_name
                ,$request->stock_us_name
                ,$request->stock_other_name
            );

            $rate = $request->rate_name;
            // dd($rate);
            $asset_info = new Asset();
            $ret = $asset_info->insertAssetInfor($arr_data);
            if($ret){
                Log::debug($request->session()->get('user_name').'  :  Success Asset Information');
                $rate_info = new Rate();
                $ret = $rate_info->insertRateInfo($arr_data[0],$rate);            
                if($ret){
                    Log::debug($request->session()->get('user_name').'  :  Success Rate Information');
                    return redirect('/top');
                }else{
                    Log::debug($request->session()->get('user_name').'  :  Failed Rate Information');
                    return redirect('/error'); 
                }
            }else{
                Log::debug($request->session()->get('user_name').'  :  Failed Asset Information');
                return redirect('/error'); 
            }
        }else{
            return redirect('/error'); 
        }        
    }

    /**
     * Delete Stock Data information
     * 
     * @param sRequest $request
     * @return json 
     */
    public function delete(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Delete Stock Data Start ==');
            $asset_id = $request->asset_id; 
            Log::debug($request->session()->get('user_name').' :  Delete ID = '.$asset_id);
            $asset_info = new Asset();
            $status = $asset_info->deleteAssetInfo($asset_id);
            return response()->json(['status'=>$status]);
        }else{
            return redirect('/error'); 
        }        
    }

}
