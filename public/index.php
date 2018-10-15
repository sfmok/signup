<?php

use GuzzleHttp\Psr7\ServerRequest;

require_once dirname(__DIR__)."/config/bootstrap.php";

$bundles = [
    App\AuthBundle\AuthBundle::class
];

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__) . '/core/config.php');
$container = $builder->build();

$kernel = new Core\Kernel($container, $bundles);

$response = $kernel->run(ServerRequest::fromGlobals());
\Http\Response\send($response);
