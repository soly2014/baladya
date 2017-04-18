<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;
use Session;
use App\Models\ViolationImage;
use App\Models\Violation;
use DB;



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

            $first_squars = User::find($id)->resQuars;

            $li = view('soly.squ',compact('first_squars'))->render();


            return response()->json(['view'=>$li ]);
        }

}


public function getSquares(Request $request)
{

        if ($request->ajax()) {

            $contractor_id = $request->id;
            $contractor_districts = DB::table('contractor_res_quar')->where('contractor_id',$contractor_id)->pluck('res_quar_id');

            $resQuars = \App\Models\ResQuar::whereIn('id',$contractor_districts)->get();
            $lis = view('soly.squ',compact('resQuars'))->render();
            if (count($resQuars) > 0) {

            return response()->json(['html'=>$lis]);

            } else {

            return response()->json(['html'=>'false']);

            }

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





