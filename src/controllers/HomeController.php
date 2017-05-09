<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 26/04/17
 * Time: 10:34
 */

namespace App\controllers;
use App\classes\Controller;
use App\model\User;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{


    /**
     * @param Request $request
     * @param Application $app
     * @return string
     */
    public function home(Request $request, Application $app)
    {

        return $app['twig']->render('homepage.html.twig');
    }
}