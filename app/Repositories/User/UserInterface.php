<?PHP

namespace App\Repositories\User;

interface UserInterface {
    public function save(array $options = []);
    public function getAll();
    public function find($id);
    public function delete($id);
}