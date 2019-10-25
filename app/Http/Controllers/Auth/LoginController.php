<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login by Vue.JS
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function vuelogin(Request $request)
    {
        try {
            if ($this->attemptLogin($request)) {
                $user = Auth::user();
                $username = $user->name;
                return response()->json([
                    'status' => 'success',
                    'user' => $username,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'user' => 'Unauthorized Access'
                ]);
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function getCredentials($request)
    {
        if (!empty($request)) {
            $requestArray = json_decode($request);

            if ($requestArray->email === 'test@muzmatch.com' && $requestArray->password === 'test123') {
                return json_encode(array('status' => 'success', 'user' => 'Muzmatch'));
            } else {
                return json_encode(array('status' => 'error', 'reason' => 'Invalid Credentials'));
            }
        } else {
            throw new Exception('Empty Request');
        }

        return;
    }


}
