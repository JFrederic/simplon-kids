<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 11:20
 */

namespace simplonkids\controllers;


use Silex\Application;
use simplonkids\model\Address;
use simplonkids\model\Kid;
use simplonkids\model\Parents;
use simplonkids\model\Workshop;
use Symfony\Component\HttpFoundation\Request;

class KidregisterController
{
    public function create(Application $app,Request $request){



        if ($request->isMethod("post")){

            $kid = new Kid();
            $parent = new Parents();
            $addresse = new Address();

            // Parent form data
            $parent_lastname = $request->get('parent_lastname');
            $parent_firstname = $request->get('parent_firstname');
            $email = $request->get('email');
            $workshop_name = $request->get('workshop_name');
            $address = $request->get('address');
            $complement = $request->get('complement');
            $city = $request->get('city');
            $zipcode = $request->get('zipcode');
            $phone = $request->get('telephone');

            // Kid form data
            $kid_lastname = $request->get('kid_lastname');
            $kid_firstname = $request->get('kid_firstname');
            $birthday = $request->get('birthday');
            $classroom = $request->get('classroom');

            $address_param = [
                'address' => $address,
                'complement' => $complement,
                'city' => $city,
                'zipcode' => $zipcode
            ];

             $address_id = $addresse->addAddress($address_param);

            $parent_param = [
                'parent_lastname' => $parent_lastname,
                'parent_firstname' => $parent_firstname,
                'email' => $email,
                'workshop_name' => $workshop_name,
                'address' => $address,
                'complement' => $complement,
                'city' => $city,
                'zipcode' => $zipcode,
                'telephone' => $phone,
                'address_id' => $address_id,
            ];

            $parent->addParent($parent_param);

            $kid_param = [
                'kid_lastname' => $kid_lastname,
                'kid_firstname' => $kid_firstname,
                'birthday' => $birthday,
                'classroom' => $classroom,
            ];

            $kid->addKid($kid_param);
        }

        $workshop = new Workshop();
        $workshops = $workshop->findAll();

        return $app['twig']->render('kid-register.html.twig' , array(
            'workshops' => $workshops,
        ));
    }
}