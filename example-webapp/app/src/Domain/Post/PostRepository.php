<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 16:36
 *
 */

namespace WebAppExample\Domain\Post;


use Blast\Orm\AbstractRepository;

class PostRepository extends AbstractRepository
{

    /**
     * Get entity for repository
     *
     * @return object
     */
    public function getEntity()
    {
        return Post::class;
    }
}