<?php

namespace App\Models;

use App\Arumaya\Rest\Model;
use Illuminate\Notifications\Notifiable;

class RestActivation extends Model
{

    use Notifiable;

    protected $tokenType = "Activation";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [  ];

    public function getActivationByID($user){
        $data = ['par_Identifier' => $user->getKey()];
        $result = static::get('/user/activationtoken/id', $data);
        if($result->status) return $result->result;
        else return FALSE;
    }

    public function getActivationByToken($token){
        $data = ['par_Identifier' => $token];
        $result = static::get('/user/activationtoken/token', $data);
        if($result->status) return $result->result;
        else return FALSE;
    }

    public function setActivation($user){
        $data = ['par_Email' => $user->Email, 'par_Token' => $this->getToken()];
        $result = static::post('/user/'.$user->getKey().'/set'.strtolower($this->tokenType).'token', $data);
        if($result->status){
            $user->token = $result->result->Token;
            return $user->token;
        }else{
            return FALSE;
        }
    }

    public function deleteActivation($token){
        // TODO: delete activation
        dd($token);
        $data = ['par_Identifier' => $token];
        $result = static::delete('/user/activationtoken/token', $data);
        if($result->status) return $result->result;
        else return FALSE;
    }

    protected function getToken(){ return hash_hmac('sha256', str_random(40), config('app.key')); }

}
