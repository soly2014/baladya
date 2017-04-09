<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StreetCreateRequest;
use App\Http\Requests\StreetUpdateRequest;
use App\Repositories\Interfaces\StreetRepository;
use App\Validators\StreetValidator;
use App\Models\ResQuar;

class StreetsController extends Controller
{

    /**
     * @var StreetRepository
     */
    protected $repository;

    /**
     * @var StreetValidator
     */
    protected $validator;

    public function __construct(StreetRepository $repository, StreetValidator $validator)
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
        $streets = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $streets,
            ]);
        }
        $title = trans('street.street');
        return view('streets.index', compact('streets','title'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //# code...
        $title = trans('street.street'). '|' .trans('street.create_street');
        $resquars = ResQuar::all();
        return view('streets.create',compact('resquars','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StreetCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'map' => 'required'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $street = $this->repository->create($request->all());

            $response = [
                'message' => trans('street.created'),
                'data'    => $street->toArray(),
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
        $street = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $street,
            ]);
        }

        return view('streets.show', compact('street'));
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
        $resquars = ResQuar::all();
        $street = $this->repository->find($id);
        $title = trans('street.street'). '|' .trans('street.update_street');
        return view('streets.edit', compact('street','resquars','title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  StreetUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'map' => 'required'
        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $street = $this->repository->update($request->all(),$id);

            $response = [
                'message' => trans('street.updated'),
                'data'    => $street->toArray(),
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
        return redirect()->back()->with('ok', trans('street.deleted'));
    }
}
