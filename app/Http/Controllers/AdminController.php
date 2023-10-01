<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Panel;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class AdminController extends BaseController
{
    public function ad_dashboard(){
        $this->data['users'] =  User::with('user_role')->get();
        $this->data['revs'] = Review::with('user')->take(2)->get();
        return view('dashboard.admin_pages.index', $this->data);
    }

   
    public function ad_reviews(Request $req){
        
        $this->data['revs'] = Review::RevFilter($req);
        $this->data['lectures'] = Review::LectureRevs();
        $this->data['users'] = Review::RevUser();
        return view('dashboard.admin_pages.review', $this->data);
    }

    public function ad_user($user){
        
        $this->data['user'] = User::with('user_role')->find($user);
        return view('dashboard.admin_pages.user', $this->data);
    }
    public function ad_user_update(Request $request){
      
        $request->validate([
            "username"=>"min:3|max:35|required",
            "email"=>"email|required",
            "phone"=>"max:10",
            "password"=>"max:15",
            "re_password"=>"same:password",
            "profile"=>"mimes:jpeg,jpg,png,gif",
        ]);
        
            DB::beginTransaction();
            try
            {
                User::where('ID','=',$request->ID)
                    ->update([
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    ]);

                $pass = md5($request->password);

                if(!$request->password == null){
                    User::where('ID','=', $request->ID)
                    ->update([
                    'password'=>$pass
                    ]);
                 }
                 if(!$request->profile == null){
                    $imgname = $request->profile->getClientOriginalName();
                    $request->profile->move(public_path().'/assets/images/profile/', $imgname);
    
                    User::where('ID','=', $request->ID)
                    ->update([
                    'photo' => $imgname
                    ]);
                 }
                
                 DB::commit();
                 return redirect()->route("ad_user",['userID'=>$request->ID]);
             }
             catch(\Exception $e)
             {
                 DB::rollBack();
                // dd($e->getMessage());
                 return redirect()->route('error')->with('errorMessage', 'An error occurred!');
             }
    }

    public function log_file_msg(Request $req){
        $this->data['log_data'] = Panel::getReportsWithRequest($req); 
        $this->data['users'] = User::all();
        return view('dashboard.admin_pages.log_file_msg', $this->data);
    }
   
 
  
}
