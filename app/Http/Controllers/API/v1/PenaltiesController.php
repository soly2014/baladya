<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PenaltyCreateRequest;
use App\Http\Requests\PenaltyUpdateRequest;
use App\Repositories\Interfaces\PenaltyRepository;
use App\Validators\PenaltyValidator;


class PenaltiesController extends Controller
{

    /**
     * @var PenaltyRepository
     */
    protected $repository;

    /**
     * @var PenaltyValidator
     */
    protected $validator;

    public function __construct(PenaltyRepository $repository, PenaltyValidator $validator)
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
        $penalties = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $penalties,
            ]);
        }

        return view('penalties.index', compact('penalties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PenaltyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PenaltyCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $penalty = $this->repository->create($request->all());

            $response = [
                'message' => 'Penalty created.',
                'data'    => $penalty->toArray(),
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
        $penalty = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $penalty,
            ]);
        }

        return view('penalties.show', compact('penalty'));
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

        $penalty = $this->repository->find($id);

        return view('penalties.edit', compact('penalty'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PenaltyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PenaltyUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $penalty = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Penalty updated.',
                'data'    => $penalty->toArray(),
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
                'message' => 'Penalty deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Penalty deleted.');
    }
}
