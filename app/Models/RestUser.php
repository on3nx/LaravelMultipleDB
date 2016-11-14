<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Arumaya\Foundation\Auth\User as Authenticatable;

class RestUser extends Authenticatable{

    use Notifiable;

    protected $connection = 'core';
    protected $primaryKey = 'UserID ';
    protected $dates = [ 'DateOfBirth', 'DateCreated', 'DateUpdated' ];
    protected $fillable = [ 'UserName', 'Email', 'Password', 'FirstName', 'LastName', 'DateOfBirth', 'Gender' ];
    protected $hidden = [ 'Password', 'RememberToken', 'Activated' ];

    public function register(array $options = []){
        $this->fill($options);
        $data = [
            'par_DateOfBirth' => $this->DateOfBirth,
            'par_Email' =>  $this->Email,
            'par_FirstName' => $this->FirstName,
            'par_Gender' =>  $this->Gender,
            'par_LastName' =>  $this->LastName,
            'par_Password' =>  $this->Password,
            'par_UserName' =>  $this->UserName,
        ];

        $result = static::post('/user/register', $data);

        if($result->status){
            $this->setAttribute($this->getKeyName(), $result->result->UserID);
            return $result;
        }else{
            //dd($result);
            return $result;
        }
    }

    public function activate($identifier = NULL, $executor = NULL){
        if($identifier === NULL) $identifier = $this->getKey();

        $data = [
            'par_Identifier' => $identifier,
            'par_IAm' =>  $$executor,
        ];

        $result = static::post('/user/activate', $data);

        if($result->status){
            $this->setAttribute($this->getKeyName(), $result->result->UserID);
            return $result;
        }else{
            //dd($result);
            return $result;
        }

    }

    public function save(){
        $data = NULL;
        foreach(($this->getDirty()) as $key => $value){
            if(in_array($key, array_merge($this->getFillable(), $this->getHidden()))) $data[$key] = $value;
        }

        if($data !== NULL){
            $result = static::patch('/user/'.$this->getKey(), ['par_IAm' => $this->getKey()], $data);
            if($result->status){
                $this->syncOriginal();
                return $result;
            }else{
                //dd($result);
                return $result;
            }
        }else{
            return null;
        }
    }

    public function getAll()
    {
        return static::all();
    }

    public function findUser($id, $executor = NULL){
        $data = ['par_IAm' =>  $executor];
        $result = static::get('/user/'.$id, $data);
        if($result->status) return $result->result;
        else return null;
    }

    public function deleteUser($id)
    {
        return static::find($id)->delete();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(){ return $this->attributes['Password']; }

    /**
     * @return string
     */
    public function getRememberTokenName(){ return 'RememberToken'; }

}
