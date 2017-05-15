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

            // Settings address form data
            $addresse->setAddress($address);
            $addresse->setComplement($complement);
            $addresse->setCity($city);
            $addresse->setZipcode($zipcode);

            $addresse->addAddress();
            $address_id = $addresse->getId();

            // Settings parent form data
            $parent->setLastname($parent_lastname);
            $parent->setFirstname($parent_firstname);
            $parent->setEmail($email);
            $parent->setTelephone($phone);
            $parent->setAddressId($address_id);
            $parent->addParent();
            $parent_id = $parent->getId();
            $kid_has_parent->setParentId($parent_id);

            // To insert a kid
            if (!empty(isset($_POST['kid_firstname']))) {

                $kid->setFirstname($kid_firstname);
                $kid->setLastname($kid_lastname);
                $kid->setBirthday($birthday);
                $kid->setClassroom($classroom);

                // To link a kid to a workshop
                $kid->addKid();
                $kidId = $kid->getId();
                $workshop_haskids->setKidId($kidId);
                $workshop_haskids->setKidsOnWorkshop();

                // To link a kid to a parent
                $kid_has_parent->setKidId($kidId);
                $kid_has_parent->setKidHasParent();

                // Settings the second child data
                $kid->setLastname($kid_lastname2);
                $kid->setFirstname($kid_firstname2);
                $kid->setBirthday($birthday2);
                $kid->setClassroom($classroom2);

                // To link a kid to a workshop
                $kid->addKid();
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