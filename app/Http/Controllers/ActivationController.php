<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Activation\ActivationInterface;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{

    protected $redirectTo = '/home';
    protected $activation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationInterface $activation){
        $this->middleware('auth');
        $this->activation = $activation;



        //if($this->activation->sendActivationMail($user));
    }
    /**
     * Show the Activation Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //TODO: Here
        $user = Auth::user()->load('profile');
        dd($user);
        return view('auth.activate');
    }

    public function activateUser($token)
    {
        if ($user = $this->activation->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }
}
