<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\library\Common;

class Expense extends Model
{
    use HasFactory;

    /**
     * Get Expense List
     * 
     * @param array $keywords
     * @return array $expenses
     */
    public function getExpenseList($keywords){
        try{
            $expenses = DB::table('t_expense')
            ->select('expense_id',DB::raw("to_char(pay_date,'mm/dd/yyyy') pay_date")
            ,'pay_amount','contents','city','state','country');

            foreach($keywords as $keyword){
                Log::debug('Keyword : '.trim($keyword));
                $keyword = trim($keyword);
                if($keyword <> ''){
                    $expenses = $expenses->where(function ($query) use ($keyword) {
                        return $query
                        ->orWhere('contents','ilike','%'.$keyword.'%')
                        ->orWhere('city','ilike','%'.$keyword.'%')
                        ->orWhere('state','ilike','%'.$keyword.'%')
                        ->orWhere('country','ilike','%'.$keyword.'%');
                    });      
                }
            }
            // Log::debug($expenses->toSql());
            $expenses = $expenses
                ->orderby('expense_id','desc')
                ->paginate(Common::PAGE_EXPENSE);

            return $expenses;        
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            return redirect('/error');
        }
    }

    /**
     * Import Expense csv
     * 
     * @param array $arr_data
     * @return boolean false/true
     */
    public function importCsv($arr_data){
        DB::beginTransaction();
        try{
            foreach($arr_data as $data){
                // dd($data);
                DB::table('t_expense')
                ->insert([
                    'pay_date' => trim($data[0])
                    ,'pay_amount' => $data[1]
                    ,'contents' => trim($data[2])
                    ,'city' => trim($data[3])
                    ,'state' => trim($data[4])
                    ,'country' => trim($data[5])
                    ,'create_date' => NOW()
                ]);
            }
            DB::commit();
            return true;
        }catch(\Exception $e){
            Log::debug('Unexpected Error!...==> RorllBack!');
            Log::debug($e->getMessage());
            DB::rollback();
            return false;
        } 
    }

}
