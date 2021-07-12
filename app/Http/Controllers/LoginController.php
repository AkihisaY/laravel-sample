<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\library\Common;

use App\Models\User;
use App\Models\Login;

class LoginController extends Controller
{
    /**
     * Open Login Page
     * 
     * @param Request $request
     * @return redirect 
     */
    public function index(Request $request){
        Log::debug('Open Login Page');
        return view('login.index',['msg'=>'']);
    }

    /**
     * login Action
     * 
     * @param Request $request
     * @return redirect 
     */
    public function login(Request $request){
        Log::info('== Open Login Page ==');
        $login_info = new Login();
        // $password = $this->setHash($request->user_pass);
        $user_name = $request->user_name;
        $user_pass = $request->user_pass;
        $url = $request->url;

        $user = $login_info->getUserInfo($user_name);
        // dd($user);
        if(!isset($user[0])){
            Log::debug($user_name.' : User does not exist.');
            return view('login.index',['msg'=>'User has not been registered.','url'=>'']); 
        }

        // Log::debug($user_name.' : user_pass :'.$user_pass.', has : '.$user[0]->pass.', Create hash:'.Common::setHash($user_pass));
        if(!password_verify($user_pass,$user[0]->pass)){
            Log::debug($user_name.' : Password is not correct.');
            return view('login.index',['msg'=>'Password is not correct','url'=>'']); 
        }

        $request->session()->put('user_name',$user_name);
        $request->session()->put('user_id',$user[0]->user_id);

        if(isset($url)){
            $url = str_replace(Common::ROOT_PATH,'',$url);
            Log::debug($user_name.' : Login ==> '.$url);
            return redirect($url);
        }else{
            return redirect('/top');
        }
    }
    
    /**
     * loguout Action
     * 
     * @param Request $request
     * @return string $hash_pass
     */
    public function logout(Request $request){
        Log::info('== Logout Action Start ==');
        $request->session()->flush();
        Log::info('== Logout Action Start ==');
        return redirect('/login');
    }

    /**
     * Open Reset Page
     * 
     * @param Request $request
     * @return redirect 
     */
    public function reset(Request $request){
        Log::debug('Open Reset Page');
        return view('login.reset');
    }

    /**
     * Open Create Page
     * 
     * @param Request $request
     * @return redirect 
     */
    public function create(Request $request){
        Log::debug('Open Create Page');
        return view('login.add');
    }

    /**
     * Insert Login Information
     * 
     * @param Request $request
     * @return redirect 
     */
    public function insert(Request $request){
        Log::debug(' : == Insert Login Information ==');
        $login_info = new Login();
        $user_name = $request->user_name;
        $user_pass = $request->password;
        $hash_pass = Common::setHash($user_pass);
        $exists_cnt = $login_info->isAlreadyEuserxists($user_name);
        if($exists_cnt == 0){
            $status = $login_info->createLoginInfo($user_name,$hash_pass);
            Log::debug(' :  User pass: '.$user_pass.', hash_pass :'.$hash_pass);
            return response()->json(['status'=>$status]);
        }else{
            Log::debug(' :  User has been registered : '.$user_name);
            return response()->json(['status'=>false]);
        }

    }

    /**
     * Open Reset Page
     * 
     * @param Request $request
     * @return redirect 
     */
    public function error(Request $request){
        Log::debug('Unexpeected Error');
        return view('login.error');
    }

    /**
     * Open Time Out Page
     * 
     * @param Request $request
     * @return redirect 
     */
    public function timeout(Request $request){
        Log::debug('Session Timeout Error');
        return view('login.timeout');
    }

}
