<?php

namespace App\Repositories\Activation;

use App\Models\RestUser;
use App\Models\RestActivation;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class ActivationRepository implements ActivationInterface
{
    protected $model = "App\Models\RestUser";
    protected $activation;
    protected $mailer;
    protected $resendAfter = 24;

    public function __construct(RestActivation $activation, Mailer $mailer)
    {
        $this->activation = $activation;
        $this->mailer = $mailer;
    }

    public function sendActivationMail($user){
        if ($this->shouldSend($user)) {
            $token = $this->activation->setActivation($user);

            //TODO: tidy activation message
            $link = route('user.activate', $token);
            $message = sprintf('Activate account %s', $link, $link);

            $this->mailer->raw($message, function (Message $m) use ($user) {
                $m->to($user->Email)->subject('Activation mail');
            });
            return true;
        }
        return false;
    }

    public function activateUser($token){
        $activation = $this->activation->getActivationByToken($token);
        if ($activation !== FALSE){
            $model = $this->createModel();
            $model->setAttribute($model->getKeyName(), $activation->UserId);
            $result = $model->activate();
            if($result !== NULL){
                return $model;
            }
        }
        return NULL;
    }

    private function shouldSend($user){
        $activation = $this->activation->getActivationByID($user);

        if($activation != FALSE){
            return !$user->activated && ($activation === null || strtotime($activation->DateUpdated) + 60 * 60 * $this->resendAfter < time());
        }else{
            // TODO: to handle return status false
            dd($activation);
            return false;
        }
    }

    private function createModel(){
        $class = '\\'.ltrim($this->model, '\\');
        return new $class;
    }

}