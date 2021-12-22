<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use Session;

use App\User;

// use App\Contact;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller{

     public function index()

    {

        $data['dashboard'] = TRUE;

        $data['page_title'] = "Contact Queries";

        $data['contacts'] = array();

            return view('admin.contact_us',$data);

    }

    public function login(Request $request){

        if($request->isMethod('post')){

            $data = $request->input();

            if(Auth::Attempt(['email'=> $data['email'], 'password' => $data['password']])){

                //Session::put('admin',$data['email']);

                return redirect('dashboard');

            }else{

                return redirect('admin')->with('flash_message_error','Invalid Username or Password!');

            }

        }

        /*if(Session::has('email')){

            return redirect('admin/dashboard');

        }*/

        //$data['page_title'] = "Login";

        return view('admin.login');

    }

    public function dashboard(){

       $data['page_title'] = "Contact Queries";

       $data['contacts'] = Contact::paginate(10);
       echo Auth::user()->type;die();
       if(Auth::user()->type=="admin"){

            return view('admin.contact_us',$data);

        }else{

            return redirect('admin')->with('flash_message_error','Please Login!');

        }

    }

    public function settings(){

        $page_title = "Settings";

        return view('admin.settings')->with(compact('page_title'));

    }

    public function updatePassword(Request $request){

        if($request->isMethod('post')){

            $data = $request->all();

            //echo "<pre>"; print_r($data); die;

            $check_password = User::where(['email' => Auth::user()->email])->first();

            $current_password = $data['old_password'];

            if(Hash::check($current_password,$check_password->password)){

                $password = bcrypt($data['password']);

                User::where('email',Auth::user()->email)->update(['password'=>$password]);

                return redirect('/admin/settings')->with('flash_message_success','Password updated Successfully!');

            }else {

                return redirect('/admin/settings')->with('flash_message_error','Incorrect Current Password!');

            }

        }

    }

    public function logout(){

        Session::flush();

        return redirect('/admin')->with('flash_message_success','Logout successfully!');

    }

    public function my_profile(){

        $profile = User::where(['email' => Auth::user()->email])->first();

        $page_title = "My Profile";

        return view('admin.my_profile')->with(compact('profile','page_title'));

    }

    //

}

