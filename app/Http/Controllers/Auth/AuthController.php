<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{

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
            return redirect()->route('home');
        } catch (ModelNotFoundException $e) {
            return redirect('https://ysitd.io/');
        }
    }

    /**
     * @param Guard $auth
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signin(Guard $auth)
    {
        if (env('APP_ENV') === 'dev') {
            $auth->loginUsingId(Uuid::NIL);
            return redirect()->route('home');
        } else {
            return redirect()->route('auth.github.oauth');
        }
    }

}
