<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Division;
use App\District;
use App\Category;
use App\Dcategory;
use App\Hospital;
use App\Doctor;
use App\Photo;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index(Request $req)
    {

        $divisions = Division::all();
        //return $divisions;
       return view('users.index',['divisions' => $divisions]);

    }
	
	public function home()
	
    {
       return view('users.index');
    }

    public function about_us(Request $req)
    {
        $divisions = Division::all();

        return view('users.about-us',['divisions' => $divisions]);
    }

    

    public function district($id)
    {
        
        $divisions = Division::all();

        $division=Division::find($id); 
        
        $district=District::find($id); 

        // $districts=District::where('division_id', '=', $divisions->id)->get();
        
        if (!$division)
        {
            throw new NotFoundHttpException;
        }
        return view('users.district')
                    ->with('divisions',  $divisions)
                    ->with('division', $division)
                    ->with('district', $district);
    }

    public function districts($id)
    {
        $divisions = Division::all();

        $division=Division::find($id); 
        
        // $districts=District::where('division_id', '=', $divisions->id)->get();
        
        if (!$division)
        {
            throw new NotFoundHttpException;
        }
        return view('users.district2')
                    ->with('divisions',  $divisions)
                    ->with('division', $division);
    }


    public function hospital($id)
    {
        
         $divisions = Division::all();
         $division=Division::find($id); 

         $district=District::find($id); 

         $categories=Category::all();
         $hospital=Hospital::find($id);

        
        // $districts=District::where('division_id', '=', $divisions->id)->get();
        
        // if (!$district)
        // {
        //     throw new NotFoundHttpException;
        // }
        return view('users.hospital')
                    ->with('divisions',  $divisions)
                    ->with('division', $division)
                    ->with('district', $district)
                    ->with('hospital',$hospital)
                    ->with('categories',$categories);
    }


    public function hospital_info($id)
    {
        $divisions = Division::all();
         $division=Division::find($id); 
         
         $district=District::find($id);
         $categories=Category::all(); 
         $category=Category::find($id);
         $hospital=Hospital::find($id);
         // $hospitals =$hospital->paginate(5);
         $hospitals = Hospital::where('district_id',$id)->paginate(2);
         

         $doctor=User::find($id);
         $doctors = User::where('district_id',$id)->paginate(1);
        // $districts=District::where('division_id', '=', $divisions->id)->get();
        
        // if (!$district)
        // {
        //     throw new NotFoundHttpException;
        // }
        return view('users.hospital_info')
                    ->with('divisions',  $divisions)
                    ->with('division', $division)
                    ->with('district', $district)
                    ->with('categories',$categories)
                    ->with('category',$category)
                    ->with('hospital',$hospital)
                    ->with('hospitals',$hospitals)
                    ->with('doctor',$doctor)
                    ->with('doctors',$doctors);
    }
    
    public function doctor_list($id)
    {
        $divisions = Division::all();
         $division=Division::find($id); 

         $district=District::find($id); 

         $categories=Category::all();
         $category=Category::find($id);

         $dcategories=Dcategory::all();
         $dcategory=Dcategory::find($id);
         
         $doctor=User::find($id);
         $doctors =User::where('id',$id)->paginate(1);
         // $photo = Photo::find($id);

        
        // $districts=District::where('division_id', '=', $divisions->id)->get();
        
        // if (!$district)
        // {
        //     throw new NotFoundHttpException;
        // }
        return view('users.doctor_list')
                    ->with('divisions',  $divisions)
                    ->with('division', $division)
                    ->with('district', $district)
                    ->with('categories',$categories)
                    ->with('category',$category)
                    ->with('dcategories',$dcategories)
                    ->with('dcategory',$dcategory)
                    ->with('doctor',$doctor)
                    // ->with('photo',$photo)
                    ->with('doctors',$doctors);
    }
    public function doctor($id)
    {
        
        $divisions = Division::all();

        $division=Division::find($id);
        $district=District::find($id); 

        $dcategories=Dcategory::all();
        $doctor=User::where('dcategory_id',$id);

        // $hospitals = Hospital::where('category_id',$id)->paginate(2);

        $doctors =User::where('dcategory_id',$id)->paginate(1);
        
        // $districts=District::where('division_id', '=', $divisions->id)->get();
        
        // if (!$division)
        // {
        //     throw new NotFoundHttpException;
        // }
        return view('users.doctor')
                    ->with('divisions',  $divisions)
                    ->with('division', $division)
                    ->with('district', $district)
                    ->with('doctor',$doctor)
                    ->with('doctors',$doctors)
                    ->with('dcategories',$dcategories);
    }

    public function doctor_info($id)
    {
         $divisions = Division::all();
         $division=Division::find($id); 

         $district=District::find($id); 

         $dcategories=Dcategory::all();
         $dcategory=Dcategory::find($id);
         
         $doctor=User::find($id);
         $doctors =User::where('district_id',$id)->paginate(1);
         
        return view('users.doctor_info')
                    ->with('divisions',  $divisions)
                    ->with('division', $division)
                    ->with('district', $district)
                    ->with('dcategories',$dcategories)
                    ->with('dcategory',$dcategory)
                    ->with('doctors',$doctors)
                    ->with('doctor',$doctor);
    }

    public function search(Request $req)
    {

        $divisions = Division::all();
    //     $name = $req->input('search');
    //     if(null !== $name)
    //         {
    //            $doctors = Doctor::where('name', 'LIKE', '%' . $name .'%')->paginate(10);
    //           return view('users.index')
    //                    ->with('divisions',$divisions)
    //                    ->with('doctors',$doctors);
    //                }
    // //         }else{
    // //           return redirect()->back();
    // //          }
        // $doctors = Doctor::orderBy('name');
        $name = $req->input('name');

        $doctors = User::where('name', 'LIKE', '%' . $name . '%')->get();
       
       return view('users.search')
                   ->with('divisions',$divisions)
                   ->with('doctors',$doctors);

     }

}
