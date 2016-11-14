<?PHP

namespace App\Repositories\User;

use Illuminate\Support\ServiceProvider;
use App\Arumaya\Platform\Auth\RestUserProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(){
        $this->app['auth']->provider('rest',function(){
            $config = $this->app['config']['auth.providers.users'];
            return new RestUserProvider($this->app['hash'], $config['model']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(){
        $this->app->bind('App\Repositories\User\UserInterface', 'App\Repositories\User\UserRepository');
    }
}