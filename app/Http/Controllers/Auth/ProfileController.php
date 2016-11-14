<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 13;
            return Carbon::now()->diff(new Carbon($value))->y >= $minAge;
        });

        return Validator::make($data, [
            'email' => 'email|max:255|unique:core.users',
            'firstname' => 'alpha|max:255',
            'lastname' => 'alpha|max:255',
            'dateofbirth' => 'date|olderThan|max:255',
            'gender' => 'boolean',
            'password' => 'min:6|confirmed',
        ]);
    }

    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {

        $this->validator($request->all())->validate();

        $anyChange = false;
        $requestOnly = [];
        $flashMessage = [];

        $user = Auth::user();

        if($request->has('email') && $request->email != $user->email) {
            $requestOnly[] = 'email';
            $flashMessage[] = '<strong>Email</strong>';
            $anyChange = true;
        }
        if($request->has('firstname') && $request->firstname != $user->firstname) {
            $requestOnly[] = 'firstname';
            $flashMessage[] = '<strong>First Name</strong>';
            $anyChange = true;
        }
        if($request->has('lastname') && $request->lastname != $user->lastname) {
            $requestOnly[] = 'lastname';
            $flashMessage[] = '<strong>Last Name</strong>';
            $anyChange = true;
        }
        if($request->has('dateofbirth') && $request->dateofbirth != $user->dateofbirth) {
            $requestOnly[] = 'dateofbirth';
            $flashMessage[] = '<strong>Date of Birth</strong>';
            $anyChange = true;
        }
        if($request->has('gender') && $request->gender != $user->gender) {
            $requestOnly[] = 'gender';
            $flashMessage[] = '<strong>Gender</strong>';
            $anyChange = true;
        }
        if($request->has('password') && !Hash::check($request->password, $user->password)) {
            if(Hash::check($request->cur_password, $user->password)){
                $new_password = bcrypt($request->input('password'));
                $user->password = $new_password;
                $user->save();
                $flashMessage[] = '<strong>Password</strong>';
                $anyChange = true;
            }
        }

        /*if($request->has('password')) {
            $new_password = bcrypt($request->input('password'));
            $user->password = $new_password;
            $user->save();
        }*/

        if($anyChange) {
            if($user->fill($request->only($requestOnly))->save())   flash()->success(preg_replace('/(.*),/', '$1 and', implode(', ', $flashMessage)) . ' Updated');
            else    flash()->error('Updated Failed');
        }else{
            flash()->success('nothing Updated');
        }

        return back();
    }
}
