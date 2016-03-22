<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 21.03.2016
 * Time: 14:27
 *
 */

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';
$app = new \Turbine\Application($config['app']);

// emulate http request from cli for testing
// convert uri={path} into $_SERVER['REQUEST_URI];
if ($app->isCli()) {
    $helper = new \WebAppExample\Helper\CliArgsHelper($argv);
    $_SERVER['REQUEST_URI'] = $helper->get('uri', '/');
}

// register all providers from configuration
foreach ($config['provider'] as $provider) {
    $app->register(new $provider);
}

$response = $app->handle(\Zend\Diactoros\ServerRequestFactory::fromGlobals());
echo $response->getBody();

$app->terminate($app->getRequest(), $response);

