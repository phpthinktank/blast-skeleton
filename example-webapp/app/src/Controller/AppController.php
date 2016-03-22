<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 17:01
 *
 */

namespace WebAppExample\Controller;


use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AppController
{

    /**
     * @var Engine
     */
    private $template;

    public function __construct(Engine $template)
    {
        $this->template = $template;
    }

    /**
     * Get app index
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function getIndex(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write($this->template->render('index', [
            'headline' => 'Blast Turbine',
            'content' => 'Say Hello!'
        ]));

        return $response;
    }

}
