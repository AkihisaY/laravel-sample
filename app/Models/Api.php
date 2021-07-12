<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\library\Common;

class Api extends Model
{
    use HasFactory;

    /**
     * Get Monthly Asset Data
     * 
     * @param String $tmp_date
     * @return array $assets 
     */
    public function getMonthlyAsset($tmp_date){
        try{
            $data = DB::table(DB::raw('t_asset'))
            ->select(
                'asset_id'
                ,DB::raw("to_char(target_date,'mm/yyyy') as target_date")
                ,'cash_jpy','cash_dol'
                ,'cash_inv_jpy','cash_inv_dol'
                ,'stock_us','stock_other'
            )
            ->where(DB::raw("to_char(target_date,'yyyymm')"),'=',$tmp_date)
            ->Where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
            ->orderby('target_date','desc');

            return $data->get();
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            return null;
        }
    }

    /**
     * Get Total Asset
     * 
     * @return array $assets 
     */
    public function getTotalAsset(){
        try{
            $data = DB::table(DB::raw('t_asset'))
                ->select(
                    'asset_id'
                    ,DB::raw("to_char(target_date,'mm/yyyy') as date")
                    ,'cash_jpy'
                    ,'cash_dol'
                    ,'cash_inv_jpy'
                    ,'cash_inv_dol'
                    ,'stock_us'
                    ,'stock_other'
                    ,DB::raw("(cash_jpy + cash_dol + cash_inv_jpy + cash_inv_dol + stock_us + stock_other) as total_amount")
                )
                ->Where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
                ->limit(100)
                ->orderby('target_date','desc');

            return $data->get();
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            return null;
        }
    }

}
