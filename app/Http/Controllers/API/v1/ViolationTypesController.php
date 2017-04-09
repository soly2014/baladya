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

        return view('violationTypes.index', compact('violationTypes'));
    }


    public function create()
    {
        # code...
        return view('violationtypes.create');
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

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $violationType = $this->repository->create($request->all());

            $response = [
                'message' => 'ViolationType created.',
                'data'    => $violationType->toArray(),
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

        $violationType = $this->repository->find($id);

        return view('violationTypes.edit', compact('violationType'));
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

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $violationType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ViolationType updated.',
                'data'    => $violationType->toArray(),
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
                'message' => 'ViolationType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ViolationType deleted.');
    }
}
