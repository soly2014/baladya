<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Models\Violation;
use App\Models\Solution;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ViolationCreateRequest;
use App\Http\Requests\ViolationUpdateRequest;
use App\Repositories\Interfaces\ViolationRepository;
use App\Validators\ViolationValidator;
use App;
use Auth;
use Session;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Input;
use App\Models\ViolationStatus;
use Carbon\Carbon;


class ViolationsController extends Controller
{

    /**
     * @var ViolationRepository
     */
    protected $repository;

    /**
     * @var ViolationValidator
     */
    protected $validator;

    public $controllerName='';


    public function __construct(ViolationRepository $repository, ViolationValidator $validator,Route $route)
    {
        $this->repository = $repository;
        $this->validator  = $validator;

        $currentAction = $route->getActionName();
        list($controller,$method) = explode('@',$currentAction);
        $this->controllerName = substr(preg_replace('/.*\\\/','',$controller), 0, -10);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $resQuarIds=array();
        foreach (Sentinel::getUser()->resQuars as $resQuar) {
            $resQuarIds[]=$resQuar->id;
        }
//dd($resQuarIds);

        if(Sentinel::getUser()->roles[0]->slug =='admin' || Sentinel::getUser()->roles[0]->slug =='manager') {

            $violations = $this->repository->all();
        }

        elseif(Sentinel::getUser()->roles[0]->slug =='contra_moderator')  {

          $violations = Violation::whereIn('res_quar_id',$resQuarIds)->get();  


        }elseif(Sentinel::getUser()->roles[0]->slug =='moderator') {
            
           // get all violations of users square
            $user_id = Session('user_object')->id;          
            $violations = Violation::whereIn('res_quar_id',$resQuarIds)->where('user_id', $user_id)->get();
            }          
            if (request()->wantsJson()) {

            return response()->json([
                'data' => $violations,
            ]);
        }


        $title = trans('violation.violation');
        // dd($violations);
        return view('violations.index', compact('violations','title'));
    }




    public function create()
    {

     $arr = [];
      Session::set('violation_images', $arr);
      Session::set('violation_video', '');
      Session::set('violation_voice', '');

      // dd(Session::get('img'));

        $title = trans('violation.violation').'|'.trans('violation.create_violation');
        //$resquars = App\Models\ResQuar::all();
        $user_id = Session('user_object')->id;
        $user = App\Models\User::find($user_id);
        $resquars = App\Models\User::find($user_id)->resQuars;
        $first_resq = $resquars[0]->id;
        //dd($first_resq->id);
        $streets = App\Models\Street::all();
        $services = App\Models\Service::all();
        $violationtypes = App\Models\ViolationType::where('service_id',$user->service_id)->get();
        $violationstatuses = App\Models\ViolationStatus::all();
        $penalties = App\Models\Penalty::all();

        return view('violations.create',compact('user','first_resq', 'resquars','streets','services','violationtypes','violationstatuses','penalties','title'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  ViolationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // dd($request->code);
       $this->validate($request, [
           
         //  'code'=>'required',
        //   'custom_penalty'=>'required'
       ]);


        try {

           // $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $inputs= $request->all();
            $inputs['service_id']=Sentinel::getUser()->service_id;
            $inputs['date']= date('Y-m-d',time());           
            //$inputs['user_id']  = Session("user_object")->id;

            //$violation = $this->repository->create($inputs);
            $violation = new App\Models\Violation();
            $violation->date =  date('Y-m-d',time());
            $violation->user_id =  Session("user_object")->id;
            $violation->res_quar_id = $inputs['res_quar_id'];
            $violation->service_id = $inputs['service_id'];
         //   $violation->street_id = $inputs['street_id'];
            $violation->violation_type_id = $inputs['violation_type_id'];

            $violation->desc = $inputs['desc'];
            $violation->code = $inputs['code'] ?: 0;

            if(session('user_role')!='moderator')
            $violation->custom_penalty = $inputs['custom_penalty'];

            $violation->address = $inputs['address'];
            $violation->longitude = $inputs['longitude'];
            $violation->latitude = $inputs['latitude'];



            /////video 
            $videoPath='';
            if(Session::get('violation_video') != '')
            {
                $videoPath =  '/assets/images/videos/'.Session::get('violation_video');
            }
            $violation->video = $videoPath;
            /* end video */


            /* voice */
            $voicePath='';
            if(Session::get('violation_voice') != '')
            {
                $voicePath =  '/assets/images/voices/'.Session::get('violation_voice');
            }
            $violation->voice = $voicePath;
            /* end voice */



            $violation->save();

            if(Session::has('violation_images'))
            {
                $count=0;
                foreach (Session::get('violation_images') as $image) {

                    $imagePath =  '/assets/images/Violations/'.$image;
                    $vimage = new App\Models\ViolationImage();
                    $vimage->violation_id = $violation->id;
                    $vimage->image = $imagePath;
                    $vimage->save();
                    $count++;

                }       
            }


            

            $response = [
                'message' => trans('violation.created'),
                'data'    => $violation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('ok', $response['message']);


            } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $violation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $violation,
            ]);
        }

        return view('violations.show', compact('violation'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = trans('violation.violation').'|'.trans('violation.update_violation');
        $resquars = App\Models\ResQuar::all();
        $streets = App\Models\Street::all();
        $services = App\Models\Service::all();
        $violationtypes = App\Models\ViolationType::where('service_id',$user->service_id)->get();        
        $violationstatuses = App\Models\ViolationStatus::all();
        $penalties = App\Models\Penalty::all();
        $violation = $this->repository->find($id);

        return view('violations.edit', compact('violation','resquars','streets','services','violationtypes','violationstatuses','penalties','title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ViolationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'date' => 'required',
            'code'=>'required|numeric',
            'custom_penalty'=>'required|numeric'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $violation = $this->repository->update($request->all(),$id);

            if($request->hasFile('images')){
                $vimages = ViolationImage::where('violation_id','=',$violation->id)->get();
//                dd($vimages);
                foreach ($request->file('images') as $image) {
                    $imagePath =  parent::image_upload($image,$this->controllerName);
                    $vimage = new App\Models\ViolationImage();
                    $vimage->violation_id = $violation->id;
                    $vimage->image = $imagePath;
                    $vimage->save();
                }
            }

            $response = [
                'message' => trans('violation.updated'),
                'data'    => $violation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('ok', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }






    public function addSolution(App\Models\Violation $violation)
    {


       if (session('user_role') == 'contra_moderator' && $violation->seen == 0) {
                
             $violation->seen = 1;
             $violation->seen_by =  session('user_object')->id;
             $violation->seen_at = Carbon::now();
             $violation->save();

       }

        $images = App\Models\ViolationImage::where('violation_id','=',$violation->id)->get();
        $statuses = \App\Models\ViolationStatus::all()->pluck('id','en_name')->toArray();
        $violation_type = \App\Models\ViolationType::where('id','=',$violation->violation_type_id)->first();
        $solutions = App\Solution::where('violation_id','=',$violation->id)->get();
        $penalty = App\Models\Penalty::where('violation_id','=',$violation->id)->first();
        $title = trans('solution.solution').'|'.trans('solution.create_solution');

        return view('solutions.create',compact('violation','images','solutions','violation_type','penalty','title'))->with('statuses', $statuses);;


    }



    public function saveSolution(Request $request)
    {

        $solution = new App\Solution($request->all());
        $solution->user_role = $request->user_role;
        $solution->save;
      
        if($request->hasFile('image')){
            
            $imagePath =  parent::image_upload($request->file('image'),$this->controllerName);
        }

        $solution->image = $imagePath;
        $solution->save();

        return redirect('/admin/violation/'.$request->all()['violation_id'].'/solution');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('message', trans('violation.deleted'));
    }
    



    /*  change vio status */
    function change_status(Request $request)
    {

        $id = $request->get('id');
        $new_status = $request->get('new_status');
        $statuses = 
        
        $violation = Violation::find($id);
        if(isset($violation))
        {
            $statuses = ViolationStatus::all()->pluck('id')->toArray();
            if(in_array($new_status, $statuses))
            {

                $violation->update(['violation_status_id'=>$new_status]);

                $status = ViolationStatus::find($new_status)->name;

                $solution = new App\Solution();

                $solution->violation_id = $violation->id;
                
                $solution->description = trans('violation.statuschanged').' '.$status;
                $solution->user_id = session('user_object')->id;

                $solution->save();

                return redirect('admin/violation/'.$id.'/solution');
            }
        }
    }




    public function addPenalty(Request $request)
    {
        # code...
        $penalty = App\Models\Penalty::where('violation_id','=',$request->all()['violation_id'])->first();
        if($penalty)
        {
            $penalty->delete();
        }

        $solution = new App\Solution();

        $solution->violation_id = $request->all()['violation_id'];
        
        $solution->description = trans('violation.penaltyvalue').' '.$request->all()['name'];
        $solution->user_id = session('user_object')->id;

        $solution->save();

        $penalty = new App\Models\Penalty($request->all());
        $penalty->save();
        return response()->json(['status'=>'success']);
    }

    public function addCustomPenalty(Request $request)
    {
        # code...
        $violation = Violation::find($request->all()['violation_id']);
        $violation->custom_penalty = $request->all()['custom_penalty'];
        $violation->save();
        return back();
    }
}
