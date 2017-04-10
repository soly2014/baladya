<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinal;
use App\Models\Violation;
use App\Models\ViolationImage;
use App\Models\Street;
use App\Models\ResQuar;
use App\Models\ViolationType;
use DB;



class ApisController extends Controller 
{




    function login(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if(isset($data['code'], $data['password']))
        {
            $user = Sentinal::authenticate([
                    'code' => $data['code'],
                    'password' => $data['password'],
                        ]) ;
            if($user)
            {
                $id = $user->id;
                $name = $user->name;
                $email = $user->email;
                $role_name = $user->roles[0]->slug;
                $solved_violations = Violation::has('solution')->where('user_id', $user->id)->count();
                return response()->json(['message'=>config('constants.general.success'),'id'=>$id, 'name'=>$name, 
                    'email'=>$email, 'role_name'=>$role_name, 'solved_violations'=>$solved_violations]);
            }
            else
            {
                return response()->json(['message'=>config('constants.general.not_found')]); //-5
            }            
        }
        else
        {
            return response()->json(['message'=>config('constants.general.fill_all_fields')]); //-1
        }       
    }
    
    



    function get_violations(Request $request)
    {
    
        $content = $request->getContent();
        
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        if(isset($data['user_id']))
        {      
            $user_id = $data['user_id'];
            $user = User::find($user_id);
     
            if($user)
            {
             
                $resQuarIds=array();
                foreach ($user->resQuars as $resQuar) 
                {
                    $resQuarIds[]=$resQuar->id;
                }
                $violations = [];
                $all_violations = [];
        

                if($user->roles[0]->slug =='admin'|| $user->roles[0]->slug =='manager') 
                {
                    $violations = Violation::all();
                } 
                elseif($user->roles[0]->slug =='contra_moderator') 
                {
                    $violations = Violation::whereIn('res_quar_id',$resQuarIds)->get();
                    
                }
                elseif($user->roles[0]->slug =='moderator') 
                {
                    $violations = Violation::whereIn('res_quar_id',$resQuarIds)->where('user_id', $user_id)->get();                    
                }               
          

                foreach ($violations as $violation)
                {
                    $solutions = [];
          
                    foreach($violation->solution as $solution)
                    {

                        $image=url('/').'/public'.$solution->image;
                        $solutions[] =[
                            'description'=>$solution->description,
                            'image'=> $image,
                            'comment_owner'=>$solution->user['first_name']." ".$solution->user['last_name'],
                            'is_accepted'=>$solution->is_accepted,
                        ];
                    }
                    $images = [];
          
                    foreach($violation->images as $image)
                    {
                        $images[] = url('/').'/public'.$image->image;

                        
                    }
 

                    $image=url('/').'/public'.$violation->image;
           
                    $all_violations[]= [

                        'id' => $violation->id,
                        'date' => $violation->date,
                        'square' => $violation->resQuar['name'],
                        'street' => $violation->street['name'],
                        'code'=> $violation->code,
                        'type'=>$violation->type['name'],
                        'desc'=>$violation->desc, 
                        'long'=>$violation->long, 
                        'lat'=>$violation->lat,
                        'violation_status_id'=>$violation->violation_status_id,
                        'video'=>asset($violation->video),
                        'voice'=>asset($violation->voice),
                        'image'=>$image,
                        'penalty'=>$violation->penalty['name'],
                        'custom_penalty'=>$violation->custom_penalty,
                        'solutions'=>$solutions,
                        'images'=>$images
                   
                    ];
                    
                  
                }
           
                return response()->json(['message'=>config('constants.general.success'), 'violations'=>$all_violations]); //1

            }
            else
            {
                return response()->json(['message'=>config('constants.general.not_found')]); //-5
            }
        }
        else
        {
            return response()->json(['message'=>config('constants.general.fill_all_fields')]); //-1
        }
    }
    
    





    function add_violation(Request $request)
    {
           
            $content = $request->getContent();
           
            $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if(isset($data['user_id'], $data['square_id'], $data['street_id'],
                    $data['violation_type_id'], $data['desc'], $data['code'], $data['address'],
                    $data['longitude'], $data['latitude']))
            {
                $user_id = $data['user_id'];
                $user = User::find($user_id);
                if($user)
                {
                    $violation = new Violation();
                    $violation->date =  date('Y-m-d',time());
                    $violation->user_id =  $data['user_id'];
                    $square_id =  $data['square_id'];
                    $violation->res_quar_id = $data['square_id'];
                    $violation->service_id = $user->service_id;
                    $violation->street_id = $data['street_id'];
                    $violation->address = $data['address'];
                    $violation->violation_type_id = $data['violation_type_id'];

                    $violation->desc = $data['desc'];
                    $violation->code = $data['code'];

                    if(session('user_role')!='moderator' && isset($data['custom_penalty']))
                        $violation->custom_penalty = $data['custom_penalty'];

                    $violation->longitude = $data['longitude'];
                    $violation->latitude = $data['latitude'];

                    if( $violation->save())
                    {
                        return response()->json(['message'=>config('constants.general.success'), 'violation_id'=>$violation->id]);
                    }
                }
                else
                {
                    return response()->json(['message'=>config('constants.general.not_found')]);
                }
            }
            else
            {
                return response()->json(['message'=>config('constants.general.fill_all_fields')]);
            }    
    }
    















    function add_violation_images(Request $request)
    {
        
        $content = $request->getContent();

        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        if(isset($data['user_id'], $data['violation_id'], $data['image']))
        {  

            $user_id = $data['user_id'];
            $user = User::find($user_id);
            $violation = Violation::find($data['violation_id']);
        
        
            if($user && $violation)
            {
        
                if(is_array($data['image']))
                {
        
                    foreach ($data['image'] as $img)
                    {
        
                        $violation_image = new ViolationImage();
/*                        $pos  = strpos($img, ';');
                        $extension = explode('/', substr($img, 0, $pos))[1];       
*/                        $path = '/assets/images/Violations/'.uniqid().'soliman.jpeg';

                        $imageSaved= file_put_contents($path, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img)));
                        $violation_image->image = $path;                         
                        $violation_image->violation_id = $violation->id;
                        $saved = $violation_image->save();                      
                    }
                }
                // end array
                else
                {
                    $violation_image = new ViolationImage();
                    
                    $img = $data['image'] ;
/*                    $pos  = strpos($img, ';');
                    dd($img,$pos);
                    $extension = explode('/', substr($img, 0, $pos));       
*/     
                    $path = 'assets/images/Violations/'.uniqid().'soliman.jpg';

                    $imageSaved= file_put_contents(public_path().'/'.$path, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img)));

                    $violation_image->image = '/'.$path;                         
                    $violation_image->violation_id = $violation->id;
                    $saved = $violation_image->save();
                    
                }
                if($saved)
                {
                    
                    return response()->json(['message'=>config('constants.general.success')]);
                     
                }
            }
            else
            {
                return response()->json(['message'=>config('constants.general.not_found')]); //user or violation not found
            }
        }
        else
        {
            return response()->json(['message'=>config('constants.general.fill_all_fields')]);
        }
    }












    function add_violation_solution(Request $request)
    {

        $content = $request->getContent();

        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        if(isset($data['violation_id'], $data['user_id'], $data['description']))
        {  
        
            $user_id = $data['user_id'];
            $user = User::find($user_id);
            $violation = Violation::find($data['violation_id']);
        
            if($user && $violation)
            {
        
                $solution = new \App\Solution($request->all());
                $solution->violation_id = $data['violation_id'];
                $solution->description = $data['description'];
                $solution->user_id = $data['user_id'];

                if(isset($data['image']))
                {
                    $img =$data['image'];


                    $path = 'assets/images/Violations/'.uniqid().'solution.jpg';

                    $imageSaved= file_put_contents(public_path().'/'.$path, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img)));

                    $solution->image = '/'.$path;                         

                }
        
                if($solution->save())
                {
                    return response()->json(['message'=>config('constants.general.success')]);
        
                }
        
            }
            else
            {
                return response()->json(['message'=>config('constants.general.not_found')]); //user or violation not found
            }
        }
        
        else
        {
            return response()->json(['message'=>config('constants.general.fill_all_fields')]);
        }
    }
    

    /* START SEARCH VIOLATIONS */

    public function search_violations(Request $request)
     {

            $content = $request->getContent();

            $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            $query = DB::table('violation')->select('*');

            if ($data['square'] != '') {
                
                $query->where('res_quar_id',$data['square']);
            }

            if ($data['violation_type'] != '') {
                
                $query->where('violation_type_id',$data['violation_type']);
            }

                //dd($data['date'],$data['square']);
            if ($data['date'] != '') {
                $query->whereDate('date',$data['date']);
            }


            return response()->json($query->get());



    }


    /* END SEARCH VIOLATIONS */



/*  GET PENALTIES */

    public function get_penalties()
    {
         
         $penalties = \App\Models\Penalty::all();

         return response()->json(['message'=>$penalties]);
    }

/*  END GET PENALTIES*/





    public function add_violation_status(Request $request)
    {

        $content = $request->getContent();

        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


        if (isset($data['violation_id']) && isset($data['status'])) {

                if (\App\Models\Violation::find($data['violation_id'])) {

                    $violation = \App\Models\Violation::find($data['violation_id']);
                    $violation->is_accepted = $data['status'];
                    $violation->reject_reasons = $data['reject_reasons'];

                    if ($data['penalty_id'] != "") {
                    $violation->penalty_id = $data['penalty_id'];
                    }

                    $violation->custom_penalty = $data['custom_penalty'];
                    $violation->save();

                    return response()->json(['message'=>'changed successfully']);


                } else {

                    return response()->json(['message'=>'No Violation found with this ID']);
                }


        } else {

            return response()->json(['message'=>'complete your credentials pls']);
        }

    }




        /* delete violation */

            public function delete_violation(Request $request)
            {
                    $content = $request->getContent();

                    $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


                    if (isset($data['violation_id'])) {

                            if (\App\Models\Violation::find($data['violation_id'])) {

                                    $Violation = \App\Models\Violation::find($data['violation_id']);
                                    $Violation->delete();

                               return response()->json(['message'=>'deleted successfully']);

                                
                            } else {

                               return response()->json(['message'=>'not found violation ID']);
                         
                            }
                            


                    } else{

                            return response()->json(['message'=>'please add violation_id']);
                    }
                
            }

        /* end delete violation */



    public function add_solution_status(Request $request)
    {

        $content = $request->getContent();

        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


        if (isset($data['solution_id']) && isset($data['status'])) {

                if (DB::table('violation_solutions')->where('id',$data['solution_id'])->first()) {

                    DB::update('update violation_solutions set is_accepted = '.$data['status'].' where id = ?', [$data['solution_id']]);

                    return response()->json(['message'=>'changed successfully']);


                } else {

                    return response()->json(['message'=>'No Solution found with this ID']);
                }


        } else {

            return response()->json(['message'=>'complete your credentials pls']);
        }

    }





//   get accepted violations

    public function get_accepted_violation()
    {
        
        $violations = \App\Models\Violation::where('is_accepted',1)->get();

        return response()->json(['violations'=>$violations]);

    }


//  get rejected solution
    public function get_rejected_violation()
    {
        
        $violations = \App\Models\Violation::where('is_accepted',0)->get();

        return response()->json(['violations'=>$violations]);

    }






    function get_single_violation(Request $request)
    {


        $content = $request->getContent();

        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        if(isset($data['violation_id']))
        {

            $violation = Violation::find($data['violation_id']);
         

            if($violation)
            {

                $solutions = [];
                foreach($violation->solution as $solution)
                {
                    $image = url('/').'/public'.$solution->image;
                    $solutions[] =[
                        'description'=>$solution->description,
                        'image'=> $image,
                        'comment_owner'=>$solution->user['first_name']." ".$solution->user['last_name'],
                        'is_accepted'=>$solution->is_accepted,
                    ];
                }


                $images = [];
                if (count($violation->images) > 0) {

                    foreach ($violation->images as  $image) {

                        $images[] = url('/').'/public'.$image->image;
                    }

                }


                $image = url('/').'/public'.$violation->image;

                $violation = [

                    'id' => $violation->id,
                    'date' => $violation->date,
                    'square' => $violation->resQuar->name,
                   'street' => \App\Models\Street::find($violation->street_id) ? \App\Models\Street::find($violation->street_id)->name : 'لا يوجد شارع تم اخياره',
                    'code'=> $violation->code,
                    'type'=>$violation->type->name,
                    'desc'=>$violation->desc, 
                    'long'=>$violation->long, 
                    'lat'=>$violation->lat,
                    'video'=> url('/').'/public'.$violation->video,
                    'voice'=> url('/').'/public'.$violation->voice,
                    'address'=>$violation->address,
                    'violation_status_id'=>$violation->violation_status_id,
                    'images'=>$images,
                    'penalty'=>$violation->penalty['name'],
                    'custom_penalty'=>$violation->custom_penalty,
                    'solutions'=>$solutions
                ];
                return response()->json(['violation'=>$violation]);
            }
            else
            {
                return response()->json(['message'=>config('constants.general.not_found')]); //user or violation not found

            }

        }
        else
        {
            return response()->json(['message'=>config('constants.general.fill_all_fields')]);
        
        }
        
    }




    function get_all_streets(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $streets = Street::all();
        foreach ($streets as $street)
        {
            $streets[]= [
                'id' => $street->id,
                'square' => $street->resquare['name'],
                'description'=> $street->desc,
                'map'=>$street->map,
                'lat'=>$street->lat, 
                'long'=>$street->long, 
                'status'=>$street->status,
            ];            
        }
        
        return response()->json(['message'=>1, 'streets'=>$streets]);
    }
   





    function get_all_squares(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $squares = ResQuar::all();
        foreach ($squares as $square)
        {
            $squares[]= [
                'id' => $square->id,
                'name' => $square->desc,
                'status'=> $square->status,                
            ];            
        } 
        return response()->json(['message'=>1, 'squares'=>$squares]);
    }





    
    function get_all_violation_types(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $violation_types = ViolationType::all();
        foreach ($violation_types as $type)
        {
            $violation_types[]= [
                'id' => $type->id,
                'name'=>$type->name,
                'service' => $type->service['name'],
                'description'=> $type->desc, 
                'max_amount'=> $type->max_amount, 
                'amount'=> $type->amount, 
                'min_amount'=> $type->min_amount,
                'health_env_type_id'=> $type->health_env_type_id,
                'status'=> $type->status,
                
            ];  
        } 
        return response()->json(['message'=>1, 'violation_types'=>$violation_types]);
    }
}

