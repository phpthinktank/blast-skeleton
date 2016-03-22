<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 16:46
 *
 */

namespace WebAppExample\Provider;


use Blast\Orm\ConnectionManager;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use League\Plates\Engine;
use Turbine\Application;
use Turbine\ApplicationInterface;
use WebAppExample\Controller\PostController;
use WebAppExample\Domain\Post\PostRepository;

class PostService extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    /**
     * @var array
     */
    protected $provides = [
        PostRepository::class
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $connection = $this->getContainer()->get(ConnectionManager::class);
        $this->install($connection);
    }

    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->getContainer()->get(ApplicationInterface::class);
        $this->registerRoutes($app);
        $this->registerTemplate();
    }

    /**
     * @param $manager
     */
    private function install(ConnectionManager $manager)
    {
        $connection = $manager->get();
        $connection->exec('CREATE TABLE IF NOT EXISTS posts (id int, title VARCHAR(255), content TEXT, slug VARCHAR(255))');
        $connection->exec('INSERT INTO posts VALUES(1, "Hello world", "My first post", "my-first-post")');
    }

    private function registerTemplate()
    {
        // @var \League\Plates\Engine
        $engine = $this->getContainer()->get(Engine::class);
        if ($engine instanceof Engine) {
            $engine->addFolder('post', __DIR__ . '/../../templates/post');
        }
    }

    /**
     * Register all relevant routes
     *
     * @param Application|ApplicationInterface $app
     */
    private function registerRoutes(Application $app)
    {
        $app->get('/post/', PostController::class . '::getIndex');
    }
}