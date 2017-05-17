<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 16/05/2017
 * Time: 11:17
 */

namespace simplonkids\controllers;


use Silex\Application;
use simplonkids\model\Admin;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AdminController
{

    public function login(Application $app, Request $request)
    {
        if ($request->isMethod('post')) {
            $username = $request->get('username');
            $password = $request->get('password');

            $admin = new Admin();
            $login = $admin->login($username);
            $roles = $admin->getRoles();

            if ($login) {
                $app['session']->set('user', $login);
                $app['session']->set('roles',$roles);
                return $app->redirect('/');
            }
            $app['session']->getFlashBag()->add('message', 'Email ou Mot de passe incorrect.');
            return $app->redirect('/{roles}/login');

        }
        return $app['twig']->render('login.html.twig');

    }


    public function logout(Application $app, Request $request)
    {
        $app['session']->clear();
        return $app->redirect('/');
    }
}