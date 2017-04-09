<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\HealthEnvTypeCreateRequest;
use App\Http\Requests\HealthEnvTypeUpdateRequest;
use App\Repositories\Interfaces\HealthEnvTypeRepository;
use App\Validators\HealthEnvTypeValidator;
use App;
use DB;

class HealthEnvTypesController extends Controller
{

    /**
     * @var HealthEnvTypeRepository
     */
    protected $repository;

    /**
     * @var HealthEnvTypeValidator
     */
    protected $validator;

    public function __construct(HealthEnvTypeRepository $repository, HealthEnvTypeValidator $validator)
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
        $healthEnvTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $healthEnvTypes,
            ]);
        }
        $title = trans('healthenvtype.healthenvtype');

        return view('healthEnvTypes.index', compact('healthEnvTypes','title'));
    }

    public function create()
    {
        # code...
        $activities = App\Models\Activity::all();
        $title = trans('healthenvtype.healthenvtype'). '|' .trans('healthenvtype.create_healthenvtype');
        return view('healthEnvTypes.create',compact('title','activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HealthEnvTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $healthEnvType = $this->repository->create($request->all());

            if($request->exists('activities'))
            {
                foreach ($request->all()['activities'] as $activity) {
                    $health_act = new App\Health_activity();
                    $health_act->health_env_type_id = $healthEnvType->id;
                    $health_act->activity_id = $activity;
                    $health_act->save();
                }
            }

            $response = [
                'message' => trans('healthenvtype.created'),
                'data'    => $healthEnvType->toArray(),
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
        $healthEnvType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $healthEnvType,
            ]);
        }

        return view('healthEnvTypes.show', compact('healthEnvType'));
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

        $healthenvtype = $this->repository->find($id);
        $activities = App\Models\Activity::all();
        $act_ids=[];
        foreach($healthenvtype->activities as $activity)
        {
            $act_ids[]=$activity->id;
        }
        $title = trans('healthenvtype.healthenvtype'). '|' .trans('healthenvtype.update_healthenvtype');
        return view('healthEnvTypes.edit', compact('activities','healthenvtype','title','act_ids'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  HealthEnvTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $healthEnvType = $this->repository->update($request->all(),$id);

            if($request->exists('activities'))
            {
                DB::table('health_activity')->where('health_env_type_id','=',$healthEnvType->id)->delete();
                foreach ($request->all()['activities'] as $activity) {
                    $health_act = new App\Health_activity();
                    $health_act->health_env_type_id = $healthEnvType->id;
                    $health_act->activity_id = $activity;
                    $health_act->save();
                }
            }

            $response = [
                'message' => trans('healthenvtype.updated'),
                'data'    => $healthEnvType->toArray(),
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

        return redirect()->back()->with('ok', trans('healthenvtype.deleted'));
    }
}
