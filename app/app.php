<?php

use Acme\BackOfficeModule\BackOfficeModule;
use Acme\BlogModule\BlogModule;
use Acme\CoreModule\CoreModule;
use Acme\FrontendModule\FrontendModule;
use DI\ContainerBuilder;
use Interop\Framework\Application;
use \Interop\Framework\Silex\SilexFrameworkModule;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/configs/config.php');
$container = $builder->build();

$app = new Application(
    [
        CoreModule::class,
        SilexFrameworkModule::class,
        FrontendModule::class,
        BlogModule::class,
        BackOfficeModule::class,
    ],
    $container
);
