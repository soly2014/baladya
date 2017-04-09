<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinal;
use Illuminate\Http\Request;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request) {

        $this->validate($request, [
            'code' => 'required',
            'password' => 'required'
        ]);
        
        $data = $request->only('code', 'password','type');
        try {
            if (!Sentinal::authenticate([
                        'code' => $data['code'],
                        'password' => $data['password'],
                            ], false)) {

                return redirect('/user/login/'.$data['type'])
                                ->with('error', trans('auth.credentials'))
                                ->withInput($request->only('code'));
            } else {
                $user = Sentinal::findByCredentials([
                            'code' => $data['code'],
                            'password' => $data['password'],
                ]);
                $request->session()->put('user_object', $user);

                $session = session("user_object");
                $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findRoleById($session->roles[0]->id);
                $role = session()->put('user_role', $role->slug);
                $type = session()->put('type',$data['type']);
                


                return redirect('admin');
            }
        } catch (Cartalyst\Sentinel\Checkpoints\ThrottlingException $ex) {
            return redirect('/')
                            ->with('error', trans('auth.too'))
                            ->withInput($request->only('code'));
        } catch (Cartalyst\Sentinel\Checkpoints\NotActivatedException $ex) {
            return redirect('/')
                            ->with('error', trans('auth.activate'))
                            ->withInput($request->only('code'));
        }
    }

   

}
