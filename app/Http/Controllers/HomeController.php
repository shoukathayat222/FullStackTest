<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use App\Signature;   
use App\Petitions;   
use App\PetitionsDescription;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $data['petitions'] = DB::table('petitions')
                    ->select('petitions.*','petitions_description.*')
                    ->join('petitions_description','petitions_description.petition_id','=','petitions.id')
                    ->orderBy('id', 'DESC')
                    ->paginate(10);

        return view('home.index',$data);
    }      
    public function detail($slug)
    {
        $data['petition'] = DB::table('petitions')
                    ->select('petitions.*','petitions_description.*')
                    ->join('petitions_description','petitions_description.petition_id','=','petitions.id')
                    ->where('petitions_description.slug',$slug)
                    ->first();

        $data['signatures'] = DB::table('signatures')
                    ->select('signatures.*','users.*')
                    ->join('users','users.id','=','signatures.user_id')
                    ->where('signatures.petition_id',$data['petition']->id)
                    ->get();
        $user_id = Auth::id();
        $check = DB::table('signatures')->where('user_id',$user_id)->where('petition_id',$data['petition']->id)->get();
        if(count($check) > 0){
            $data['check'] = true;
        }else{
            $data['check'] = false;
        }
        // dd($data['signatures']);
        // $data['slug'] = $slug;
        return view('home.detail',$data);
    }  

    public function addSignature(Request $request){

        if(!Auth::check()){

            return redirect()->back()->with('flash_message_error','Please login first!');

        }
        $data = $request->input();
        $signature = new Signature;
        $signature->text =  $data['text'] ??  "";
        $signature->petition_id =  $data['petition_id'];
        $signature->user_id =  Auth::id();
        $signature->added_on =  date('Y-m-d h:i:s');
        $signature->save();

        return redirect()->back()->with('flash_message_success','Signature added successfull!');
    }
    public function login(Request $request)
    {
        if($request->isMethod('post')){

             $request->validate([
                
                "email"    => "required|string|min:1",
                "password"    => "required|string|min:1",
    
            ]);

            $data = $request->input();

            if(Auth::Attempt(['email'=> $data['email'], 'password' => $data['password']])){

                return redirect('/');

            }else{

               return redirect()->back()->with('flash_message_error','Invalid Username or Password!');

            }
        }

        return view('home.sigin');
    }
    public function register(Request $request)
    {
        if($request->isMethod('post')){

             $request->validate([
                
                'name' => 'required|min:2|max:50',

                'email' => 'required|email|unique:users',

                'password' => 'required|min:6',

                'confirm_password' => 'required|min:6|max:20|same:password',

    
            ]);

            $data = $request->input();

            $user = new User;

            $user->name = $data['name'] ??  "";

            $user->email = $data['email'];

            $user->password = bcrypt($data['password']);

            $user->save();
            return redirect()->back()->with('flash_message_success','You have been Registerd successfull!');

        }

        return view('home.signup');
    }
    public function logout(){

        Session::flush();
        $url = url('/');
        return redirect($url);

    }

}