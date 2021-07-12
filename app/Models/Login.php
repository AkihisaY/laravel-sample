<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;

    /**
     * Get Login Password
     * 
     * @param string $user_name
     * @return boolean true false 
     */
    public function getLoginPassword($user_name){
        DB::beginTransaction();
        try{
            $query = DB::table('m_login')
                    ->select(DB::raw('pass'))
                    ->where('user_name','=',$user_name)
                    ->where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
                    ->get();
            return $query[0]->pass;
        }catch(\Throwable $e) {
            Log::debug($e->getMessage());
            return redirect('/error'); 
        }
    }

    /**
     * Insert Login Information
     * 
     * @param string $passrod
     * @return boolean true false 
     */
    public function createLoginInfo($user_name,$password){
        DB::beginTransaction();
        try{
            DB::table('m_login')
            ->insert([
                'user_name' => $user_name
                ,'pass' => $password
                ,'create_date' => NOW()
            ]);

            DB::commit();
            return true;
        }catch(\Throwable $e){
            Log::debug($e->getMessage());
            DB::rollback();
            return false;
        }
    }

    /**
     * Get Login User Info
     * 
     * @param string $user_name
     * @return boolean true false 
     */
    public function getUserInfo($user_name){
        DB::beginTransaction();
        try{
            $query = DB::table('m_login')
            ->select('user_id','pass')
            ->where('user_name','=',$user_name)
            ->where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
            ->get();

            return $query;
        }catch(\Throwable $e){
            Log::debug($e->getMessage());
            return redirect('/error'); 
        }
    }

    /**
     * Get Login User Id
     * 
     * @param string $user_name
     * @param string $password
     * @return boolean true false 
     */
    public function isAlreadyEuserxists($user_name){
        DB::beginTransaction();
        try{
            $query = DB::table('m_login')
                ->select(DB::raw('count(user_id) as cnt'))
                ->where('user_name','=',$user_name)
                ->where(DB::raw("COALESCE(delete_flg,'')"),'<>','1')
                ->get();

            return $query[0]->cnt;
        }catch(\Thowable $e){
            Log::debug($e->getMessage());
            return redirect('/error'); 
        }

    }
}
