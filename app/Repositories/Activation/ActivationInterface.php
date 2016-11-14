<?PHP

namespace App\Repositories\Activation;

interface ActivationInterface {
    public function sendActivationMail($user);
    public function activateUser($token);

}