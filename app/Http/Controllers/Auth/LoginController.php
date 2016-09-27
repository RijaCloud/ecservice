<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserHasLoggedIn;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/gstion/admin';

    /**
     * The maximum login attempt when login failed
     *
     * @var integer
     * */
    protected $maxAttempt = 3;

    /**
     * Time during which the user must wait (:minutes)
     *
     * @var integer
     * */
    protected $lockoutTime = 1;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm() {

        return view('admin.login-admin');

    }

    /**
     * Get the throttle key for the given request.
     * Add the application into the prefix
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function throttleKey(Request $request) {

        return Str::lower('everyCycle'.$request->input($this->username()) .'||'.$request->ip());

    }



    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function hasTooManyLoginAttempts(Request $request) {
        
        return $this->limiter()->tooManyAttempts(
          $this->throttleKey($request) , $this->maxAttempt , $this->lockoutTime  
        );
        
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    public function authenticated(Request $request , $user) {
        
        event(new UserHasLoggedIn($this->guard()->user()));
        
        return $user;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username() {

        return 'name';
        
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : 'gstion/admin';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()->json([$this->username() => $message],422);

    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|exists:users', 'password_confirmation' => 'required',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credential = [$this->username() => $request->input($this->username()), 'password' => $request->input('password_confirmation')];

        return $credential;
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response(['password_confirmation' => [Lang::get('validation.confirmed')]],422  );
    }

}
