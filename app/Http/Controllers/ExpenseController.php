<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\library\Common;
use Illuminate\Http\Request;

use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Expense Action
     * 
     * @param Request $request
     * @return redirect 
     */
    public function index(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Open Expense Page ==');
            $expense_info = new Expense();
            $expenses = $expense_info->getExpenseList(); 
            return view('expense.index',['expenses'=>$expenses]);
        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }
    }


}
