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

$app->get('/', 'simplonkids\controllers\HomeController::home');
$app->get('/workshops', 'simplonkids\controllers\WorkshopController::show');
//$app->match('/workshops', 'simplonkids\controllers\WorkshopController::getWorkshopByPublicAge');
$app->match('/create/workshop', 'simplonkids\controllers\WorkshopController::create');
$app->match('/edit/{id}', 'simplonkids\controllers\WorkshopController::edit');
$app->match('/register' , 'simplonkids\controllers\KidregisterController::create');
$app->get('/faq', function() use($app) {

    return $app['twig']->render('faq.html.twig');
});
$app->get('/contact', function() use($app) {

    return $app['twig']->render('contact.html.twig');
});






$app['debug'] = true;
$app->run();