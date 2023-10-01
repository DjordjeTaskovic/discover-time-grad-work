<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserInputRequest;
use App\Models\Notification;
use App\Models\Panel;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function loginpage(){
        return view('pages.auth.login', $this->data);
    }
    
    public function logout(Request $request){
        Panel::lognote("User has logged-out of an account.", false);
        $request->session()->remove("user");
        return redirect()->route("home");
    }

    public function registerpage(){
        return view('pages.auth.register', $this->data);
    }

    public function login(Request $request){

        $email = $request->input('dzEmail');
        $password = $request->input('dzPassword');
        $pass = md5($password);

        try {

                $user = User::getUser_email_pass($email, $pass);
                
                if($user){
                    $user->subscriptions = User::getUserSubs($user->ID);
                    if($user->role_name =='administrator'){
                        $user->admin_role = true;
                    }else{
                        $user->admin_role = false;
                    }
                     $request->session()->put("user", $user);
                    Panel::lognote("User has logged-in into an account on site.", false);
                    return redirect()->route("home");

                }if($user = "null"){
                    Panel::lognote("User login failed.", true);
                    return redirect()->route("loginpage")
                    ->with('errorMessage', 'User information are not alright!');

                }
            } catch (\Exception $e) {
                   // dd($e->getMessage());
                    return redirect()->route("error")
                    ->with('errorMessage', 'An error occurred!');
                }
        
    }
//UserInputRequest
    public function register(UserInputRequest $request){
  
        $pass = md5($request->dzPassword);
        DB::beginTransaction();
        try{
                $userID = User::insertUser($request->dzUsername, $request->dzEmail, $pass);
                DB::commit();

                Panel::lognote("New user has been registered.",false);

                Notification::message($userID, 'Welcome to our site', 'Welcome to our site new-comer! We are looking
                forward to make you stay and learn as much as you can about history. Be sure to check out the latest lectures on the site.');

                //adding free subscription (ID - 1) to new registered user
                DB::table('user_subscriptions')->insert([
                    'user_ID' => $userID,
                    'subscription_ID'=> 1
                ]);
                //login_after_register
                $logedin_user = User::getUser_id($userID);

                if($logedin_user->role_name =='administrator'){
                    $logedin_user->admin_role = true;
                }else{
                    $logedin_user->admin_role = false;
                }

               if($logedin_user){
                $logedin_user->subscriptions = User::getUserSubs($logedin_user->ID);
                $request->session()->put("user", $logedin_user);
                return redirect()->route("home");
            }
            if($logedin_user = "null"){
                return redirect()->route("loginpage")
                ->with('errorMessage', 'User information are not alright!');
             }
        } catch (\Exception $th) {
            DB::rollBack();
          //  dd($th->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
    }
    public function error(){
        return view('pages.other.error',$this->data);
    }
   
}
