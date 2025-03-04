<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login\mst_user;
use App\Role_Models\mst_role;
use Illuminate\Support\Facades\Hash;
class OCMSLoginController extends Controller
{
    
    public function login_process(Request $request){

     $username = $request->input('email');
     $pass = $request->input('password');

     $checkuser = mst_user::selectRaw("Count(user_id) as Total")->where("email_id","=",$username)->where("is_active",1)->first();

     if(intval($checkuser->Total) > 0){

         $getpass = mst_user::select("password")->where("email_id","=",$username)->where("is_active",1)->first();
             //dd($getpass);
             //if(MD5::check($pass, $getpass->password))/*($pass == $getpass->password)*/{ //password_verify
                //dd(md5($pass),$getpass->password);
            if(md5($pass)==$getpass->password)  {  
                $username = mst_user::select('mst_user.Full_name','user_id','role_id')->where("email_id","=",$username)->where("is_active",1)->first();
               //dd($username);exit;
                $request->session()->put('username',$username->Full_name);
                $request->session()->put('uid',$username->user_id);
				        $request->session()->put('role_id',$username->role_id);

                /*echo $products = session('username');
                echo $product = session('uid');*/

                //echo $products;echo $product;exit();
                if($username->role_id == 4){
                  return redirect("/BulkFileUpload");
                }
                else if($username->role_id == 3){
                  return redirect("/lodgedComplaint");
                }else{
                return redirect("/Dashboard");
              }
            }else{
                return redirect("/")->with("info","Please Check username or password");
            }
        }else{
            return redirect("/")->with("info","Please Check username or password");
        }

    }

    public function logout(Request $request){
        Session::forget('uid');
        Session::forget('username');
        $request->session()->flush();
        return redirect("/");
    }

}


