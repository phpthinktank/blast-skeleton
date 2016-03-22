<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 14:38
 *
 */

namespace WebAppExample\Provider;


use Blast\Orm\ConnectionManager;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use League\Plates\Engine;
use Turbine\Application;
use Turbine\ApplicationInterface;
use WebAppExample\Controller\AppController;

class AppProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

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
        $this->registerDatabase();
        $this->registerTemplateEngine();
    }

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    /**
     * Register all relevant routes
     *
     * @param Application|ApplicationInterface $app
     */
    private function registerRoutes(Application $app)
    {
        $app->get('/', AppController::class . '::getIndex');
    }

    /**
     * Register all relevant routes
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function registerDatabase()
    {
        $manager = ConnectionManager::getInstance();
        $manager->add('sqlite:///webappexample.sqlite');
        $this->getContainer()->share(ConnectionManager::class, $manager);
    }

    private function registerTemplateEngine()
    {
        $engine = new Engine(__DIR__ . '/../../templates/default');
        $this->getContainer()->share(Engine::class, $engine);
    }
}
