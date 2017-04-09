<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ViolationCreateRequest;
use App\Http\Requests\ViolationUpdateRequest;
use App\Repositories\Interfaces\ViolationRepository;
use App\Validators\ViolationValidator;


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

    public function __construct(ViolationRepository $repository, ViolationValidator $validator)
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
        $violations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $violations,
            ]);
        }

        return view('violations.index', compact('violations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ViolationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ViolationCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $violation = $this->repository->create($request->all());

            $response = [
                'message' => 'Violation created.',
                'data'    => $violation->toArray(),
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

        $violation = $this->repository->find($id);

        return view('violations.edit', compact('violation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ViolationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ViolationUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $violation = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Violation updated.',
                'data'    => $violation->toArray(),
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
                'message' => 'Violation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Violation deleted.');
    }
}
