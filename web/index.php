<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 18/04/17
 * Time: 13:11
 */

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';




$app = new Silex\Application();
$app->register(new \Silex\Provider\AssetServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider());

require __DIR__.'/../config/prod.php';

$app->get('/', 'App\controllers\HomeController::home');






$app['debug'] = true;
$app->run();