<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 26/04/17
 * Time: 10:34
 */

namespace simplonkids\controllers;
use Silex\Application;
use simplonkids\model\Workshop;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{


    /**
     * @param Request $request
     * @param Application $app
     * @return string
     */
    public function home(Application $app)
    {
        $workshop = new Workshop();
        $workshops = $workshop->findAll();
        return $app['twig']->render('homepage.html.twig',array(
            'workshops' => $workshops,
        ));
    }
}