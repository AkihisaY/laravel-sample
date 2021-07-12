<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\library\Common;

class Rate extends Model
{
    use HasFactory;

    /**
     * Insert Asset Information
     * 
     * @param string $target_date
     * @param numeric $rate
     * @return boolean true/false 
     */
    public function insertRateInfo($target_date,$rate){
        DB::beginTransaction();
        try{
            DB::table('t_rate')
            ->insert([
                'target_date' => $target_date
                ,'rate' => $rate
                ,'create_date' => NOW()
            ]);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return false;
        }
    }
}
