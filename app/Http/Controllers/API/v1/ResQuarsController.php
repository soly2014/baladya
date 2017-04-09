<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ResQuarCreateRequest;
use App\Http\Requests\ResQuarUpdateRequest;
use App\Repositories\Interfaces\ResQuarRepository;
use App\Validators\ResQuarValidator;


class ResQuarsController extends Controller
{

    /**
     * @var ResQuarRepository
     */
    protected $repository;

    /**
     * @var ResQuarValidator
     */
    protected $validator;

    public function __construct(ResQuarRepository $repository, ResQuarValidator $validator)
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
        $resQuars = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $resQuars,
            ]);
        }

        return view('resQuars.index', compact('resQuars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ResQuarCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ResQuarCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $resQuar = $this->repository->create($request->all());

            $response = [
                'message' => 'ResQuar created.',
                'data'    => $resQuar->toArray(),
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
        $resQuar = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $resQuar,
            ]);
        }

        return view('resQuars.show', compact('resQuar'));
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

        $resQuar = $this->repository->find($id);

        return view('resQuars.edit', compact('resQuar'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ResQuarUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ResQuarUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $resQuar = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'ResQuar updated.',
                'data'    => $resQuar->toArray(),
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
                'message' => 'ResQuar deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ResQuar deleted.');
    }
}
