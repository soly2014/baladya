<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserVisitCreateRequest;
use App\Http\Requests\UserVisitUpdateRequest;
use App\Repositories\Interfaces\UserVisitRepository;
use App\Validators\UserVisitValidator;
use App\Models\ResQuar;
use App\Models\Street;
use App\Models\User;
use App\Models\Role;
use App\Models\Facility;
use App\Models\FacilityStatus;
use App\Models\UserVisit;
use App\Models\Activity;
use App;

class UserVisitsController extends Controller
{

    /**
     * @var UserVisitRepository
     */
    protected $repository;

    /**
     * @var UserVisitValidator
     */
    protected $validator;

    public function __construct(UserVisitRepository $repository, UserVisitValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        // $uservisits = $this->repository->all();
        if(session('user_role') == 'moderator')
        {
            $uservisits = UserVisit::where('date','=',date('m/d/Y'))->where('users_id','=',session('user_object')->id)->get();
        }
        else{
            $uservisits = UserVisit::all();    
        }
        


        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userVisits,
            ]);
        }
        $title = trans('uservisit.uservisit');
        return view('userVisits.index', compact('uservisits','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserVisitCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userVisit = $this->repository->create($request->all());

            $response = [
                'message' => trans('uservisit.created'),
                'data'    => $userVisit->toArray(),
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





    public function create()
    {

        $title = trans('uservisit.uservisit').'|'.trans('uservisit.create_uservisit');
        
        $uservisits = UserVisit::where('date','=',date('m/d/Y'))->get();
        $users = Role::find(3)->users;
        $resquars = ResQuar::all();
        $streets = Street::all();
        $facilities = Facility::all();
        $facility_statuses = FacilityStatus::all();

        return view('userVisits.create',compact('uservisits','users','resquars','streets','facilities','facility_statuses','title'));
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
        $userVisit = $this->repository->find($id);
        $hviolation = App\Health_violation::where('visit_id','=',$userVisit->id)->first();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userVisit,
            ]);
        }
        $title = trans('uservisit.uservisit').'|'.trans('uservisit.show_uservisit');
        return view('userVisits.show', compact('userVisit','title','hviolation'));
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
        $title = trans('uservisit.uservisit').'|'.trans('uservisit.update_uservisit');
        $users = Role::find(3)->users;
        $resquars = ResQuar::all();
        $streets = Street::all();
        $facilities = Facility::all();
        $facility_statuses = FacilityStatus::all();
        $userVisit = $this->repository->find($id);
        return view('userVisits.edit', compact('userVisit','users','resquars','streets','facilities','facility_statuses','title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserVisitUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            
            'date' => 'required'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userVisit = $this->repository->update($request->all(),$id);

            $response = [
                'message' => trans('uservisit.updated'),
                'data'    => $userVisit->toArray(),
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('ok', trans('uservisit.deleted'));
    }

    public function dayVisits(Request $request)
    {
        # code...
        $dayvisits = UserVisit::where('date','=',$request->all()['day'])->get();
        // dd($dayvisits);
        $visits = [];
        foreach ($dayvisits as $visit) {
            # code...
            $singlev= [
            'url'=>url('/').'/admin/health_violation/create'.'/'.$visit->id,
            'visit_id'=> $visit->id,
            'user' => User::where('id','=',$visit->users_id)->first()->first_name .' '.User::where('id','=',$visit->users_id)->first()->last_name,
            'date' => $visit->date,
            'facility' => Facility::where('id','=',$visit->facility_id)->first()->banner_name
            ];
            $visits[]=$singlev;
        }
        return response()->json(['dayvisits' =>$visits]);
    }

    public function getViolationsTypes($facility_id)
    {
        $facility = Facility::find($facility_id);
        if($facility->activity_type_id){
            $activity = Activity::find($facility->activity_type_id);
            return response()->json(['dayvisits' =>$activity->healthenvtypes]);;
        }
        return response()->json(['dayvisits' =>"No Health Violation Type Found"]);

    }

    public function finishVisit(Request $request)
    {
        $visit = UserVisit::find($request->all()['userVisitId']);
        $visit->status = 'تمت الزياره';
        $visit->save();
        return response()->json(['ok' =>"OK"]);   
    }
}
