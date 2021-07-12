<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\library\Common;

class Key extends Model
{
    use HasFactory;
    /**
     * Get Key List
     * 
     * @param String $user_id
     * @return array $keys
     */
    public function getKeyList($user_id){
        try{
            $keys = DB::table('t_key')
            ->select(DB::raw("to_char(create_date,'mm/dd/yyyy') create_date")
            ,'key_id','project_key','project_name','delete_flg')
            ->where('user_id','=',$user_id)
            ->orderby('key_id','desc')
            ->get();

            return $keys;        
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            return redirect('/error');
        }
    }

    /**
     * Create Project Key
     * 
     * @param Integer $user_id
     * @param String $project_name
     * @return boolean true/false 
     */
    public function insertProjectKey($user_id,$project_name){
        $project_key = Common::makeRandStr(10);
        DB::beginTransaction();
        try{
            DB::table('t_key')
            ->insert([
                'project_key' => $project_key
                ,'project_name' => $project_name
                ,'user_id' => $user_id
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

    /**
     * Delete Project Key
     * 
     * @param Integer $user_id
     * @param Integer $key_id
     * @return boolean true/false 
     */
    public function deleteProjectKey($user_id,$key_id){
        DB::beginTransaction();
        try{
            DB::table('t_key')
                ->where('key_id','=',$key_id)
                ->where('user_id','=',$user_id)
                ->update([
                    'delete_flg' => '1'
                    ,'modify_date' => NOW()
                ]);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return false;
        }
    }


    /**
     * Recover Project Key
     * 
     * @param Integer $user_id
     * @param Integer $key_id
     * @return boolean true/false 
     */
    public function recoverProjectKey($user_id,$key_id){
        DB::beginTransaction();
        try{
            DB::table('t_key')
            ->where('key_id','=',$key_id)
            ->where('user_id','=',$user_id)
            ->update([
                'delete_flg' => null
                ,'modify_date' => NOW()
            ]);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return false;
        }
    }

    /**
     * Get Key List
     * 
     * @param Integer $user_id
     * @param String $project_key
     * @return Boolean True/False
     */
    public function isValidKey($user_id,$project_key){
        try{
            $key = DB::table('t_key')
                    ->select(DB::raw("count(*) as cnt"))
                    ->where('user_id','=',$user_id)
                    ->where('project_key','=',$project_key)
                    ->Where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
                    ->get();

            if($key[0]->cnt > 0){
                return true;        
            }else{
                return false;        
            }
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            return false;
        }
    }

}
