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
     * @return array $expenses
     */
    public function getExpenseList(){
        try{
            $expenses = DB::table('t_expense')
            ->select('expense_id',DB::raw("to_char(pay_date,'mm/dd/yyyy') pay_date")
            ,'pay_amount','contents','city','state','country')
            ->orderby('expense_id','desc')
            ->paginate(Common::PAGE_EXPENSE);

            return $expenses;        
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            return redirect('/error');
        }
    }

}
