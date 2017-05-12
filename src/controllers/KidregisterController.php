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
use simplonkids\model\KidHasParent;
use simplonkids\model\Parents;
use simplonkids\model\Workshop;
use simplonkids\model\WorkshopHasKids;
use Symfony\Component\HttpFoundation\Request;

class KidregisterController
{
    public function create(Application $app, Request $request)
    {


        if ($request->isMethod("post")) {

            $kid = new Kid();
            $parent = new Parents();
            $addresse = new Address();
            $workshop_haskids = new WorkshopHasKids();
            $kid_has_parent = new KidHasParent();


            $parent_lastname = $request->get('parent_lastname');
            $parent_firstname = $request->get('parent_firstname');
            $email = $request->get('email');
            $workshop_id = $request->get('workshop_id');
            $address = $request->get('address');
            $complement = $request->get('complement');
            $city = $request->get('city');
            $zipcode = $request->get('zipcode');
            $phone = $request->get('telephone');
            $workshop_haskids->setWorkshopId($workshop_id);

            // Kid 1 form data
            $kid_lastname = $request->get('kid_lastname');
            $kid_firstname = $request->get('kid_firstname');
            $birthday = $request->get('birthday');
            $classroom = $request->get('classroom');

            // Kid 2 form data
            $kid_lastname2 = $request->get('kid_lastname2');
            $kid_firstname2 = $request->get('kid_firstname2');
            $birthday2 = $request->get('birthday2');
            $classroom2 = $request->get('classroom2');

            // Address param form data
            $address_param = [
                'address' => $address,
                'complement' => $complement,
                'city' => $city,
                'zipcode' => $zipcode
            ];
            $addresse->addAddress($address_param);
            $address_id = $addresse->getId();

                // Parent param form data
            $parent_param = [
                'parent_lastname' => $parent_lastname,
                'parent_firstname' => $parent_firstname,
                'email' => $email,
                'workshop_id' => $workshop_id,
                'address' => $address,
                'complement' => $complement,
                'city' => $city,
                'zipcode' => $zipcode,
                'telephone' => $phone,
                'address_id' => $address_id,
            ];
            $parent->addParent($parent_param);
            $parent_id = $parent->getId();
            $kid_has_parent->setParentId($parent_id);

            if (!empty(isset($_POST['kid_firstname']))) {
                $kid_param = [
                    'kid_lastname' => $kid_lastname,
                    'kid_firstname' => $kid_firstname,
                    'birthday' => $birthday,
                    'classroom' => $classroom,
                ];

                // To link a kid to a workshop
                $kid->addKid($kid_param);
                $kidId = $kid->getId();
                $workshop_haskids->setKidId($kidId);
                $workshop_haskids->setKidsOnWorkshop();

                // To link a kid to a parent
                $kid_has_parent->setKidId($kidId);
                $kid_has_parent->setKidHasParent();


                $kid_param2 = [
                    'kid_lastname' => $kid_lastname2,
                    'kid_firstname' => $kid_firstname2,
                    'birthday' => $birthday2,
                    'classroom' => $classroom2,
                ];

                // To link a kid to a workshop
                $kid->addKid($kid_param2);
                $kidId = $kid->getId();
                $workshop_haskids->setKidId($kidId);
                $workshop_haskids->setKidsOnWorkshop();

                // To link a kid to a parent
                $kid_has_parent->setKidId($kidId);
                $kid_has_parent->setKidHasParent();

                $app->redirect('/');
            }

        }
        $workshop = new Workshop();
        $workshops = $workshop->findAll();

        return $app['twig']->render('kid-register.html.twig', array(
            'workshops' => $workshops,
        ));
    }


}