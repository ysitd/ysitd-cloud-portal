<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\Contracts\Factory;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    /**
     * @var \Illuminate\Auth\SessionGuard
     */
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Route for github oauth
     *
     * @param Factory $factory
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function githubRedirect(Factory $factory)
    {
        return $factory->driver('github')
            ->with(['allow_signup' => false])
            ->redirect();
    }

    /**
     * Callback route for Github oauth
     *
     * @param Factory $factory
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function githubCallback(Factory $factory)
    {
        try {
            $data = $factory->driver('github')->user();
        } catch (\Exception $e) {
            return redirect('auth/github');
        }

        try {
            $user = User::where('user_name', $data->getName())
                ->findOrFail();
            $this->auth->login($user);
            return redirect()->route('home');
        } catch (ModelNotFoundException $e) {
            return redirect('https://ysitd.io/');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signin()
    {
        if (env('APP_ENV') === 'dev') {
            $this->auth->loginUsingId(Uuid::NIL);
            return redirect()->route('home');
        } else {
            return redirect()->route('auth.github.oauth');
        }
    }

    public function signout()
    {
        $this->auth->logout();
        return redirect()->route('home');
    }

}
