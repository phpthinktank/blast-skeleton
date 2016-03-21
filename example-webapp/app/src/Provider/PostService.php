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
use WebAppExample\Domain\Post\PostRepository;

class PostService extends AbstractServiceProvider
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
     * @param $manager
     */
    private function install(ConnectionManager $manager)
    {
        $manager->get()->exec('CREATE TABLE IF NOT EXISTS post (id int, title VARCHAR(255), content TEXT, slug title VARCHAR(255))');
    }
}