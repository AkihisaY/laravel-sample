<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\library\Common;
use Illuminate\Http\Request;

use App\Models\Expense;

use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;

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
            $search_key = $request->keywords;
            Log::debug($request->session()->get('user_name').' :  Get Keywords : '.$search_key);
            $keywords = explode(" ",$search_key);

            $expense_info = new Expense();
            $expenses = $expense_info->getExpenseList($keywords);            
            return view('expense.index',['expenses'=>$expenses,'search_key' => $search_key]);
        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }
    }

    /**
     * Open Expense import Page
     * 
     * @param Request $request
     * @return view 
     *  
     */
    public function csv(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Open Expense Import Page ==');
            return view('expense.csv');
        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }
    }

    /**
     * Import Csv
     * 
     * @param Request $request
     * @return view 
     *  
     */
    public function import(Request $request){
        if($request->session()->get('user_name') != ""){
            Log::info($request->session()->get('user_name').' : == Open Expense Import Page ==');
            if($request->hasFile('csv_file') && $request->file('csv_file')->isValid()){
                // $file = $request->file('csv_file');
                $file_name = $request->file('csv_file')->getClientOriginalName();
                $request->file('csv_file')->storeAs('/public',$file_name);
                // dd(public_path().'/storage/'.$file_name);
                $file_path = public_path()."/storage/".$file_name;
                $config_in = new LexerConfig();
                $config_in
                    ->setFromCharset("SJIS-win")
                    ->setToCharset("UTF-8") // Change --> UTF8
                    ->setIgnoreHeaderLine(false) //Ignore Header
                ;
                $lexer_in = new Lexer($config_in);

                $interpreter = new Interpreter();
                $interpreter->addObserver(function (array $row) use (&$arr_data){
                   //Get Each Column Data
                   $arr_data[] = $row;
                });
                
                //parse CSV Data
                $lexer_in->parse($file_path,$interpreter);
                //Delete Tmp File
                unlink($file_path);      
                // dd($arr_data);
                $expense_info = new Expense();
                $expense_info->importCsv($arr_data);

            }
            return redirect('/expense');
        }else{
            return view('login.index',['msg'=>'','url'=>url()->full()]); 
        }
    }

}
