<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ViolationTypeCreateRequest;
use App\Http\Requests\ViolationTypeUpdateRequest;
use App\Repositories\Interfaces\ViolationTypeRepository;
use App\Validators\ViolationTypeValidator;
use App\Models\ViolationType;
use App\Models\Service;
use App\Models\HealthEnvType;

class ViolationTypesController extends Controller
{

    /**
     * @var ViolationTypeRepository
     */
    protected $repository;

    /**
     * @var ViolationTypeValidator
     */
    protected $validator;

    public function __construct(ViolationTypeRepository $repository, ViolationTypeValidator $validator)
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
        $violationTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $violationTypes,
            ]);
        }
        $title = trans('violationtype.violationtype');

        return view('violationtypes.index', compact('violationTypes','title'));

    }






    public function create()
    {

       
        $title = trans('violationtype.violationtype').'|'.trans('violationtype.create_violationtype');
        $services = Service::all();
        $health_envs = HealthEnvType::all();

        return view('violationtypes.create',compact('services','health_envs','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ViolationTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'duration'=>'required|numeric',
            'amount'=>'required|numeric',
            'max_amount'=>'required|numeric',
            'min_amount'=>'required|numeric',
        ]);

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $violationType = $this->repository->create($request->all());

            $response = [
                'message' => trans('violationtype.created'),
                'data'    => $violationType->toArray(),
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
        $violationType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $violationType,
            ]);
        }

        return view('violationTypes.show', compact('violationType'));
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

        $title = trans('violationtype.violationtype').'|'.trans('violationtype.update_violationtype');
        $violationType = $this->repository->find($id);
        $services = Service::all();
        $health_envs = HealthEnvType::all();
        return view('violationtypes.edit', compact('violationType','services','health_envs','title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ViolationTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'duration'=>'required|numeric',
            'amount'=>'required|numeric',
            'max_amount'=>'required|numeric',
            'min_amount'=>'required|numeric'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $violationType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => trans('violationtype.updated'),
                'data'    => $violationType->toArray(),
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

        return redirect()->back()->with('ok', trans('violationtype.deleted'));
    }
}
