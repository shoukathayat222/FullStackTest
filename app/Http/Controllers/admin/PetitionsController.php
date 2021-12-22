<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Image;

use App\Petitions;   

use App\User;

use App\PetitionsDescription;

use Illuminate\Support\Facades\DB;

use App\Language;

use Illuminate\Http\Request;

class PetitionsController extends Controller

{

    public function __construct()

    {

        $data = array();

        $data['catalog'] = TRUE;

    }

    public function view()

    {

      $petitions = DB::table('petitions')
                    ->select('petitions.*','petitions_description.*')
                    ->join('petitions_description','petitions_description.petition_id','=','petitions.id')
                    ->orderBy('id', 'DESC')
                    ->paginate(10);

      $page_title = "Petitions";

      $users=User::get();   

      $user_id = '';

      $title = "";

      return view('admin.petitions.view')->with(compact('users','petitions','page_title', 'user_id', 'title'));

    }

    public function add()

    {

        $page_title = "Add Petitions";

        return view('admin.petitions.add')->with(compact('page_title'));

    }


    public function create(Request $request)

    {

        if($request->isMethod('post')){

  
            $request->validate([
                
                "title"    => "required|string|min:1"
    
            ]);

            $data = $request->all();

            $feature = new Petitions; 

            $feature->status = $data['status'];
            $feature->date_added = date('Y-m-d h:i:s');

            if($request->hasFile('image')){

                $image_tmp = $request->image; //Input::file('image');

                if($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();

                    $filename = rand(111,99999).'.'.$extension;

                    $image_path ='assets/images/categories/'.$filename;

                    // Resize Images

                    Image::make($image_tmp)->save($image_path);

                    $feature->image = $filename;

                }

            }


            $feature->save();

            $feature_id = Petitions::orderBy('id', 'DESC')->pluck('id')->first();

            $data = $request->all();

            $finalArray = array();

            for($i=0; $i < 1;  $i++){

                $slug = $data['title'];

                $slug = str_replace(' ', '_', $slug);

                array_push($finalArray, array(

                    'petition_id'=> $feature_id,

                    'title'=>$data['title'],

                    'slug'=>$slug,

                    'description'=>$data['description']

                  )

                );

            }

            PetitionsDescription::insert($finalArray);

            return redirect('view-petitions')->with('flash_message_success','Record added successfully!');      

        }

        $page_title = "Add Petitions";

        return view('admin.petitions.add')->with(compact('page_title'));

    }

    public function edit(Request $request, $id){

            if($request->isMethod('post')){

                $request->validate([
                
                "title"    => "required|string|min:1"
    
                ]);

            $data = $request->all();

            if($request->hasFile('image')){

                $image_tmp = $request->image; //Input::file('image');

                if($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();

                    $filename = rand(111,99999).'.'.$extension;

                    $image_path = 'images/categories/'.$filename;

                    // Resize Images

                    Image::make($image_tmp)->save($image_path);

                    Petitions::where(['id'=>$id])->update(['image'=>$filename]);

                }

            }

            $updateArray['status'] = $data['status'];

            Petitions::where(['id'=>$id])->update($updateArray);

            $data = $request->all();

            $count_items = 1;

                $prescription = PetitionsDescription::where('petition_id',$id);

                $slug = $data['title'];

                $slug = str_replace(' ', '_', $slug);

                $prescription->update([

                    'title'=>$data['title'],

                    'slug'=>$slug ,

                    'description'=>$data['description'],


                ]);

        
            return redirect('view-petitions')->with('flash_message_success','Record updated Successfully!');

        }

        $petitions = DB::table('petitions')

            ->select('petitions.*','petitions_description.*','petitions.status as status')

                ->join('petitions_description','petitions_description.petition_id','=','petitions.id')

                ->where('petitions_description.petition_id','=',$id)

                ->get();  


        $page_title = "Edit Petitions";

        $id=$id;

        return view('admin.petitions.edit')->with(compact('id','petitions','page_title'));

    }

    public function delete(Request $request, $id = null){

        if($request->isMethod('post')){

            $data = $request->all();

            foreach ($data['selected'] as $id) {

                if(!empty($id)){

                    Petitions::where(['id'=>$id])->delete();

                    PetitionsDescription::where(['petition_id'=>$id])->delete();

                }

            }

            return redirect()->back()->with('flash_message_success','Record deleted Successfully!');

        }

    }

}