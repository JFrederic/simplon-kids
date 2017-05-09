<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 18/04/17
 * Time: 14:27
 */

// configure your app for the production environment

$app['twig.path'] = array(__DIR__ . '/../views');
$app['twig.options'] = array('debug' => true);
$app['twig']->addExtension(new Twig_Extension_Debug());

