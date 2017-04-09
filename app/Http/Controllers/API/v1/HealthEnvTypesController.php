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

        return view('healthEnvTypes.index', compact('healthEnvTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HealthEnvTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HealthEnvTypeCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $healthEnvType = $this->repository->create($request->all());

            $response = [
                'message' => 'HealthEnvType created.',
                'data'    => $healthEnvType->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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

        $healthEnvType = $this->repository->find($id);

        return view('healthEnvTypes.edit', compact('healthEnvType'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  HealthEnvTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(HealthEnvTypeUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $healthEnvType = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'HealthEnvType updated.',
                'data'    => $healthEnvType->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'HealthEnvType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'HealthEnvType deleted.');
    }
}
