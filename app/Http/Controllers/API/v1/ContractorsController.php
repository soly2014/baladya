<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContractorCreateRequest;
use App\Http\Requests\ContractorUpdateRequest;
use App\Repositories\Interfaces\ContractorRepository;
use App\Validators\ContractorValidator;


class ContractorsController extends Controller
{

    /**
     * @var ContractorRepository
     */
    protected $repository;

    /**
     * @var ContractorValidator
     */
    protected $validator;

    public function __construct(ContractorRepository $repository, ContractorValidator $validator)
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
        $contractors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contractors,
            ]);
        }

        return view('contractors.index', compact('contractors'));
    }

    public function create()
    {
        # code...
        return view('contractors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContractorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contractor = $this->repository->create($request->all());

            $response = [
                'message' => 'Contractor created.',
                'data'    => $contractor->toArray(),
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
        $contractor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contractor,
            ]);
        }

        return view('contractors.show', compact('contractor'));
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

        $contractor = $this->repository->find($id);

        return view('contractors.edit', compact('contractor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ContractorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contractor = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Contractor updated.',
                'data'    => $contractor->toArray(),
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
                'message' => 'Contractor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Contractor deleted.');
    }
}
