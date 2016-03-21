<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 17:05
 *
 */
$this->layout('layout/default', ['title' => 'User Profile']) ?>

<h1><?= $this->e($headline); ?></h1>
<p><?= $this->e($content); ?></p>
