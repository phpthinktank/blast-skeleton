<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 16:56
 *
 */

namespace WebAppExample\Controller;


use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebAppExample\Domain\Post\PostRepository;

class PostController
{

    /**
     * @var PostRepository
     */
    private $repository;
    /**
     * @var Engine
     */
    private $engine;

    /**
     * Inject controller dependencies.
     *
     * Load post repository
     *
     * @param PostRepository $repository
     * @param Engine $engine
     */
    public function __construct(PostRepository $repository, Engine $engine)
    {
        $this->repository = $repository;
        $this->engine = $engine;
    }

    public function getIndex(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write('My Post Content');
        return $response;
    }

}