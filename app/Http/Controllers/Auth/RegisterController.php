<?php

namespace App\Http\Controllers\Auth;

use App\Models\RestUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/activate';
    protected $resultType = 'success';
    protected $resultMessage = 'activationStatus';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 13;
            return Carbon::now()->diff(new Carbon($value))->y >= $minAge;
        });

        Validator::extend('restUnique', function($attribute, $value, $parameters)
        {
            // TODO: create unique rest validator
            return null;
        });

        return Validator::make($data, [
            'username' => 'required|max:255',//|unique:core.users', // <-- can't use this because rest api
            'email' => 'required|email|max:255',//|unique:core.users', // <-- can't use this because rest api
            'firstname' => 'required|alpha|max:255',
            'lastname' => 'required|alpha|max:255',
            'dob' => 'required|date|olderThan|max:255',
            'gender' => 'required|in:Male,Female',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        if($user != null) {
            event(new Registered($user));
            $this->guard()->login($user);
        }

        return redirect($this->redirectPath())->with($this->resultType, $this->resultMessage);

        //$this->guard()->login($user);
        //return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return RestUser
     */
    protected function create(array $data){
        // tidy up user data;
        $userData = [
            'UserName' => $data["username"],
            'Email' => $data["email"],
            'FirstName' => $data["firstname"],
            'LastName' => $data["lastname"],
            'DateOfBirth' => $data["dob"],
            'Gender' => $data["gender"],
            'Password' => bcrypt($data["password"])
        ];

        $user = new RestUser($userData);
        $result = $user->register();
        if($result->status === true) return $user;
        else{
            $this->resultType = 'error';
            $this->resultMessage = 'generalError';
        }

        if(stripos($result->result,"Duplicate") !== false){
            if(Str::contains($result->result, 'username')){
                $this->resultType = 'warning';
                $this->resultMessage = 'usernameExist';
            }elseif(Str::contains($result->result, 'email')){
                $this->resultType = 'warning';
                $this->resultMessage = 'emailExist';
            }
        }
        $this->redirectTo = '/register';

        return null;
    }
}
