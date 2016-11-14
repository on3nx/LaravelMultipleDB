<?PHP

namespace App\Repositories\User;

use App\Models\RestUser;

class UserRepository implements UserInterface
{
    public $user;

    function __construct(RestUser $user) {
        $this->user = $user;
    }

    public function save(array $options = [])
    {
        return $this->user->save($options);
    }

    public function getAll()
    {
        return $this->user->getAll();
    }

    public function find($id)
    {
        return $this->user->findUser($id);
    }

    public function delete($id)
    {
        return $this->user->deleteUser($id);
    }
}