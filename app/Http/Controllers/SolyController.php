<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;
use Session;
use App\Models\ViolationImage;
use App\Models\Violation;



class SolyController extends Controller
{
    

     public function getStreets(Request $request)
    {

    	$id = $request->id;
        $streets = Street::where('res_quar_id',$id)->get();

    	if (count($streets) > 0) {
    		
    		$view = view('soly.streets',compact('streets'))->render();
    		return response()->json(['view'=>$view]);
    	} else {

    		return response()->json('false');
    	}



    }



public function getLocation(Request $request)
{

        if ($request->ajax()) {

            $id = $request->id;
            $squars = \App\Models\ResQuar::find($id);

          //  return response()->json(['long'=>46.682558 , 'lat'=>24.632028]);
            return response()->json(['long'=>$squars->long , 'lat'=>$squars->lat]);
        }

}


public function getSquares(Request $request)
{

        if ($request->ajax()) {

            $id = $request->id;
            $squars = \App\Models\ResQuar::find($id);

          //  return response()->json(['long'=>46.682558 , 'lat'=>24.632028]);
            return response()->json(['long'=>$squars->long , 'lat'=>$squars->lat]);
        }


}


    public function addImageViolation(Request $request)
    {

      //  dd(Session::get('violation_images'));
         
         $image = $request->file('file');
         
         $imageName = time().'::'.$image->getClientOriginalName();
          
         $targetDir =$_SERVER['DOCUMENT_ROOT'] .'/assets/images/Violations';

         $image->move($targetDir,$imageName);


         $old = Session::get('violation_images');

        Session::set('violation_images',array_prepend($old,$imageName));



    }





    public function addVoiceViolation(Request $request)
    {

      //  dd(Session::get('violation_images'));
         
         $image = $request->file('file');
         
         $imageName = time().$image->getClientOriginalName();
          
         $targetDir =$_SERVER['DOCUMENT_ROOT'] .'/assets/images/voices';

         $image->move($targetDir,$imageName);


//         $old = Session::get('violation_voices');

        Session::set('violation_voice',$imageName);



    }





    public function addVideoViolation(Request $request)
    {

      //  dd(Session::get('violation_images'));
         
         $image = $request->file('file');
         
         $imageName = time().$image->getClientOriginalName();
          
         $targetDir =$_SERVER['DOCUMENT_ROOT'] .'/assets/images/videos';

         $image->move($targetDir,$imageName);


       //  $old = Session::get('violation_videos');

        Session::set('violation_video',$imageName);



    }


/* CLEAR SESSION */
public function clearSession(Request $request)
{

     $filename = $request->file;
     $new_session = Session::get('violation_images');

     foreach ($new_session as $key) {

         if (explode('::', $key)[1] == $filename) {

            if(($key = array_search($key, $new_session)) !== false) {

                unset($new_session[$key]);

            }

         }
     }

     Session::set('violation_images',$new_session);
     return Session::get('violation_images');

}


}





