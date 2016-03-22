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


use Blast\Orm\Entity\Provider;
use League\Plates\Engine;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebAppExample\Domain\Post\PostRepository;
use WebAppExample\Helper\InputHelper;
use Zend\Diactoros\Response\JsonResponse;

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

    /**
     * Get a list of all posts
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function getIndex(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write($this->engine->render('post::index',
            [
                'headline' => 'Posts',
                'posts' => $this->repository->all()
            ]
        ));

        return $response;
    }

    /**
     * Get a post entry by slug or id
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws NotFoundException
     */
    public function getEntry(ServerRequestInterface $request, ResponseInterface $response)
    {

        $input = InputHelper::filterInputByKeys(
            $request->getQueryParams(),
            ['id', 'slug']
        );

        if (is_numeric($input['id'])) {
            $entity = $this->repository->find($input['id']);
        } elseif (is_string($input['id'])) {
            $entity = $this->repository->findBySlug($input['slug']);
        } else {
            throw new NotFoundException('Post not found');
        }

        $provider = new Provider($entity);

        $response->getBody()->write($this->engine->render('post::entry',
            $provider->fetchData()
        ));

        return $response;

    }

    /**
     * Save a post
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return JsonResponse
     */
    public function postEntry(ServerRequestInterface $request, ResponseInterface $response)
    {

        $provider = new Provider($this->repository->getEntity());
        $id = $this->repository->save(
            $provider->withData(
                InputHelper::filterInputByKeys(
                    $request->getParsedBody(),
                    ['id', 'title', 'content', 'slug']
                )
            )
        );

        return new JsonResponse(['success' => true, 'post_id' => $id], $response->getStatusCode(), $response->getHeaders());

    }

    /**
     * Delete a post
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return JsonResponse
     */
    public function deleteEntry(ServerRequestInterface $request, ResponseInterface $response)
    {
        $input = InputHelper::filterInputByKeys(
            $request->getParsedBody(), ['id']
        );

        return new JsonResponse(
            [
                'success' => $this->repository->createMapper($this->repository->getEntity())->delete($input['id']),
                'post_id' => $input['id']
            ], $response->getStatusCode(), $response->getHeaders()
        );

    }

}
