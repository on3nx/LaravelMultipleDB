<?php

namespace App\Arumaya\Platform\Auth;

use App\Models\RestUser;
use App\Arumaya\Platform\Rest\RestModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\UserProvider as UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class RestUserProvider00 extends RestModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    UserProvider
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    public function retrieveById($identifier){
        $user = $this->getUserByIdentifier($identifier);
        $user = static::asJson($user);
        return $this->getRestUser(static::fromJson($user));
    }

    public function retrieveByToken($identifier, $token){
        dd("TODO: retrieveByToken");
    }

    public function updateRememberToken(AuthenticatableContract $user, $token){
        dd("TODO: updateRememberToken");
    }

    public function retrieveByCredentials(array $credentials){
        $identifier = $credentials['identifier'];
        return $this->retrieveById($identifier);
        /*dd($credentials/0);
        $user = $this->getUserByIdentifier($credentials['username']);
        if($user !== null) {
            //todo: i'm here to match below attr is correct or not with the one that i set during registration
            $user = [
                "Activated" => $user->Activated,
                "CreatedBy" => $user->CreatedBy,
                "DateCreated" => $user->DateCreated,
                "DateOfBirth" => $user->DateOfBirth,
                "DateUpdated" => $user->DateUpdated,
                "Email" => $user->Email,
                "FirstName" => $user->FirstName,
                "Gender" => $user->Gender,
                "LastName" => $user->LastName,
                "UpdatedBy" => $user->UpdatedBy,
                "UserID" => $user->UserID,
                "UserName" => $user->UserName,
            ];
        }
        return $this->getRestUser($user);*/
    }

    public function validateCredentials(AuthenticatableContract $user, array $credentials){
        $plain = $credentials['password'];
        dd($this->hasher->check($plain, $user->getAuthPassword()));
        return $this->hasher->check($plain, $user->getAuthPassword());
    }

    /**
     * Get the api user.
     *
     * @param  mixed  $user
     * @return \App\Models\RestUser|null
     */
    protected function getRestUser($user){
        if ($user !== null) {
            return new RestUser($user);
        }
    }

    protected function getUserByIdentifier($identifier){ //todo: here
        $data = ['par_IAm' =>  $this->getKey()];
        $result = static::get('/user/'.$identifier, $data);

        if($result->status){
            return $result->result;
        }else{
            // TODO: to handle return status false
            return NULL;
        }
    }

}