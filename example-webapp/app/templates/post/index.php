<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 22.03.2016
 * Time: 09:12
 *
 */

$this->layout('layout/default', ['title' => $headline]) ?>

<h1><?= $this->e($headline); ?></h1>
<ul>
    <?php foreach($posts as $post):
        if(!($post instanceof \WebAppExample\Domain\Post\Post)){
            continue;
        }
    ?>
        <li><a href=""><?= $post->getTitle() ?></a></li>
    <?php endforeach; ?>
</ul>
