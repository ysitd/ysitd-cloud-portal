<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Route for github oauth
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function githubRedirect()
    {
        return Socialite::driver('github')
            ->with(['allow_signup' => false])
            ->redirect();
    }

    /**
     * Callback route for Github oauth
     *
     * @param Guard $auth
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function githubCallback(Guard $auth)
    {
        try {
            $data = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect('auth/github');
        }

        try {
            $user = User::where('github_id', $data->getId())
                ->where('user_name', $data->getName())
                ->findOrFail();
            $auth->login($user);
            return redirect('/');
        } catch (ModelNotFoundException $e) {
            return redirect('https://ysitd.io/');
        }
    }

}
