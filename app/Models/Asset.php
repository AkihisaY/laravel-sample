<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\library\Common;

class Asset extends Model
{
    use HasFactory;

    /**
     * Get Asset List
     * 
     * @return array $assets 
     */
    public function getAssetList(){
        try{
            $assets = DB::table(DB::raw('t_asset ta'))
            ->select(
                'ta.asset_id'
                ,'ta.target_date'
                ,DB::raw("to_char(ta.target_date,'mm/yyyy') as display_date")
                ,'ta.cash_jpy','ta.cash_usd'
                ,'ta.cash_inv_jpy','ta.cash_inv_usd'
                ,'ta.stock_us','ta.stock_other'
                ,'tr.rate'
            )
            ->leftjoin(DB::raw('t_rate tr'),'ta.target_date','=','tr.target_date')
            ->Where(DB::raw("COALESCE(ta.delete_flg,'')"),'<>','1')
            ->orderby('ta.target_date','desc')
            ->paginate(Common::PAGE);
            
            return $assets;

        }catch(\Exception $e){
            report($e);
            return redirect('/error'); 
        }

    }

    /**
     * Get This Month Asset Information
     * 
     * @return array $assets 
     */
    public function getThisMonthAsset(){
        $date = date('Ymd');
        try{
            $assets = DB::table(DB::raw('t_asset ta'))
            ->select(
                'ta.asset_id'
                ,'ta.target_date'
                ,DB::raw("to_char(ta.target_date,'mm/yyyy') as display_date")
                ,'ta.cash_jpy','ta.cash_usd'
                ,'ta.cash_inv_jpy','ta.cash_inv_usd'
                ,'ta.stock_us','ta.stock_other'
                ,'tr.rate'
            )
            ->leftjoin(DB::raw('t_rate tr'),'ta.target_date','=','tr.target_date')
            ->Where(DB::raw("COALESCE(ta.delete_flg,'')"),'<>','1')
            ->Where(DB::raw("to_char(ta.target_date,'yyyymmdd')"),'=',$date)
            ;

            return $assets->get();
        }catch(\Exceptioin $e){
            Log::debug($e->getMessage());
            return redirect('/error'); 
        }
    }


    /**
     * Insert Asset Information
     * 
     * @param array $arr_data
     * @return boolean true/false 
     */
    public function insertAssetInfor($arr_data){
        DB::beginTransaction();
        try{
            $assets = DB::table('t_asset')
            ->insert([
                'target_date' => $arr_data[0]
                ,'cash_jpy' => $arr_data[1]
                ,'cash_usd' => $arr_data[2]
                ,'cash_inv_jpy' => $arr_data[3]
                ,'cash_inv_usd' => $arr_data[4]
                ,'stock_us' => $arr_data[5]
                ,'stock_other' => $arr_data[6]
                ,'create_date' => NOW()
            ]);
            DB::commit();
            return true;
        }catch(\Throwable $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return false; 
        }
    }


    /**
     * Delete Asset Information
     * 
     * @param id $asset_id
     * @return boolean true/false 
     */
    public function deleteAssetInfo($asset_id){
        DB::beginTransaction();
        try{
            $asset = DB::table('t_asset')
                ->where('asset_id', $asset_id)
                ->update(['delete_flg' => 1, 'modify_date' => NOW()]);    
            DB::commit();
            return true;    
        }catch(\Throwable $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return false; 
        }
    }

    /**
     * Get Asset Category Month
     * 
     * @return array $asset
     */
    public function getCategoryAssetMonth(){
        $date = date('Ym');
        DB::beginTransaction();
        try{
            $asset = DB::table('t_asset')
            ->select( 'cash_jpy','cash_usd','cash_inv_jpy'
            ,'cash_inv_usd','stock_us','stock_other')
            ->where(DB::raw("to_char(target_date,'yyyymm')"),'=',$date)
            ->get();

            return $asset;
        }catch(\Throwable $e){
            Log::debug($e->getMessage());
            return null; 
        }
    }

    /**
     * Get Category Data
     * 
     * @return array $asset
     */
    public function getCategoryStackedAsset(){
        DB::beginTransaction();
        try{
            $asset = DB::table('t_asset')
            ->select(DB::raw("to_char(target_date,'mm/yy') input_date")
            ,'cash_jpy','cash_usd','cash_inv_jpy'
            ,'cash_inv_usd','stock_us','stock_other')
            ->where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
            ->limit(5)
            ->orderby('target_date','desc')
            ->get();

            return $asset;        
        }catch(\Throwable $e){
            Log::debug($e->getMessage());
            return null; 
        }
    }

}
