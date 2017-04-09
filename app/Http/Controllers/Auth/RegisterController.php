<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use App\Notifications\ConfirmEmail;
use App\Models\User;

class RegisterController extends Controller {

    use RegistersUsers;

    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    public function role() {
//        $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::getRoleRepository()->createModel()->create([
//            'name' => 'Contra Moderator',
//            'slug' => 'contra_moderator',
//        ]);
    }

    public function admin() {
        echo 1;
    }

    /**
     * Handle a registration request for the application
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @param  \App\Repositories\UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function register() {

        $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findRoleByName('Contra Manager');

        $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::create([
                    'first_name' => 'Ahmed',
                    'last_name' => 'Fathi',
                    'code' => '1155',
                    'email' => 'example5@gmail.com',
                    'password' => '123'
        ]);

        // attach the user to the role
        $role->users()->attach($user);

        // create a new activation for the registered user
        $activation = (new Cartalyst\Sentinel\Activations\IlluminateActivationRepository)->create($user);
//        mail($data['email'], "Activate your account", "Click on the link below \n <a href='http://vaprobash.dev/user/activate?code={$activation->code}&login={$user->id}'>Activate your account</a>");

        echo "Please check your email to complete your account registration.";





//        $user = $userRepository->store(
//                $request->all(), str_random(30)
//        );
//
//        $this->notifyUser($user);
//
//        return redirect('/')->with('ok', trans('front/verify.message'));
    }

    /**
     * Handle a confirmation request
     *
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  string  $confirmation_code
     * @return \Illuminate\Http\Response
     */
    public function confirm(UserRepository $userRepository, $confirmation_code) {
        $userRepository->confirm($confirmation_code);

        return redirect('/')->with('ok', trans('front/verify.success'));
    }

    /**
     * Handle a resend request
     *
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(UserRepository $userRepository, Request $request) {
        if ($request->session()->has('user_id')) {
            $user = $userRepository->getById($request->session()->get('user_id'));

            $this->notifyUser($user);

            return redirect('/')->with('ok', trans('front/verify.resend'));
        }

        return redirect('/');
    }

    /**
     * Notify user with email
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function notifyUser(User $user) {
        $user->notify(new ConfirmEmail($user->confirmation_code));
    }

}
