<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 09:15
 */

namespace simplonkids\controllers;


use Silex\Application;
use simplonkids\model\Establishment;
use simplonkids\model\Kid;
use simplonkids\model\PublicAge;
use simplonkids\model\Timetable;
use simplonkids\model\Workshop;
use simplonkids\model\WorkshopCategory;
use Symfony\Component\HttpFoundation\Request;
use simplonkids\model\WorkshopHasKids;

class WorkshopController
{

    public function show(Application $app) {

        $workshop = new Workshop();
        $public_age = new PublicAge();
        $workshop_category = new WorkshopCategory();
        $establishment = new Establishment();

         $workshops = $workshop->findAll();
         $ages = $public_age->findAll();
         $categories = $workshop_category->findAll();
         $establishments = $establishment->findAll();



        return $app['twig']->render('workshop.html.twig',array(
            'workshops' => $workshops,
            'ages' => $ages,
            'categories' => $categories,
            'establishments' => $establishments,
        ));
    }



    public function create(Application $app,Request $request) {

        $public_age = new PublicAge();
        $workshop_category = new WorkshopCategory();
        $establishment = new Establishment();

        if ($request->isMethod("post")){

            $workshop = new Workshop();
            $timetable = new Timetable();

            $title = $request->get('title');
            $description = $request->get('description');
            $price = $request->get('price');
            $max_kids = $request->get('max_kids');
            $image = $request->get('image');
            $visible = $request->get('visible');
            $public_age_id = $request->get('public_age_id');
            $establishment_id = $request->get('establishment_id');
            $workshop_category_id = $request->get('workshop_category_id');
            $start = $request->get('startAt');
            $end = $request->get('endAt');

            if ($visible == "on"){
                $visible = 1;
            }
            else {
                $visible = 0;
            }
            // Add a workshop
            $workshop->setTitle($title);
            $workshop->setDescription($description);
            $workshop->setPrice($price);
            $workshop->setMaxKids($max_kids);
            $workshop->setImage($image);
            $workshop->setVisible($visible);
            $workshop->setPublicAgeId($public_age_id);
            $workshop->setEstablishmentId($establishment_id);
            $workshop->setWorkshopCategoryId($workshop_category_id);
            $workshop->addWorkshop();

            // Add a timetable for a workshop
            $workshop_id = $workshop->getId();
            $timetable->setStartAt($start);
            $timetable->setEndAt($end);
            $timetable->setEnable(0);
            $timetable->setWorkshopId($workshop_id);
            $timetable->addTimetable();

            return $app->redirect('/workshops');
        }

        return $app['twig']->render('create_workshop.html.twig', array(
            'ages' => $public_age->findAll(),
            'categories' => $workshop_category->findAll(),
            'establishments' => $establishment->findAll(),
        ));

    }

    public function edit(Application $app,Request $request , $id) {

        $public_age = new PublicAge();
        $workshop_category = new WorkshopCategory();
        $establishment = new Establishment();

        if ($request->isMethod("post")){

            $workshop = new Workshop();
            $timetable = new Timetable();

            $title = $request->get('title');
            $description = $request->get('description');
            $price = $request->get('price');
            $max_kids = $request->get('max_kids');
            $image = $request->get('image');
            $visible = $request->get('visible');
            $public_age_id = $request->get('public_age_id');
            $establishment_id = $request->get('establishment_id');
            $workshop_category_id = $request->get('workshop_category_id');
            $start = $request->get('startAt');
            $end = $request->get('endAt');

            if ($visible == "on"){
                $visible = 1;
            }
            elseif($visible == "false") {
                $visible = 0;
            }
            $workshop->setTitle($title);
            $workshop->setDescription($description);
            $workshop->setPrice($price);
            $workshop->setMaxKids($max_kids);
            $workshop->setImage($image);
            $workshop->setVisible($visible);
            $workshop->setPublicAgeId($public_age_id);
            $workshop->setEstablishmentId($establishment_id);
            $workshop->setWorkshopCategoryId($workshop_category_id);
            $workshop->setId($id);
            $workshop->editWorkshop();

            $workshop_id = $workshop->getId();
            $timetable->setStartAt($start);
            $timetable->setEndAt($end);
            $timetable->setEnable(0);
            $timetable->setWorkshopId($workshop_id);
            $timetable->editTimetable();

            return $app->redirect('/workshops');
        }
        $workshop = new Workshop();
        $edit_workshop = $workshop->findWorkshopById($id);
        $startAt = date('d-m-Y H:i',strtotime($edit_workshop['startAt']));
        $endAt = date('d-m-Y H:i',strtotime($edit_workshop['endAt']));
        $edit_workshop['startAt']  = strtr($startAt, '-', '/');
        $edit_workshop['endAt']  = strtr($endAt, '-', '/');

        return $app['twig']->render('edit_workshop.html.twig',array(
            'edit_workshop' => $edit_workshop,
            'ages' => $public_age->findAll(),
            'categories' => $workshop_category->findAll(),
            'establishments' => $establishment->findAll(),
        ));

    }

    public function delete(Application $app, Request $request)
    {
        $id = $request->get('id');
        $workshop = new Workshop();
        $workshop->delete($id);
        return $app->redirect('/workshops');
    }

    public function WorkshopSubscriptionRequest(Application $app,Request $request) {

        $workshop_has_kid = new WorkshopHasKids();
        $workshop = new Workshop();
        $kid = new Kid();

        if ($app['session']->get('user')){
            $subscription_request = $workshop_has_kid->findByNotValidated();
            $workshops = $workshop->findAll();
            $kids = $kid->findAll();
            return $app['twig']->render('ask-list.html.twig', array (
                'subscriptions_request' => $subscription_request ,
                'workshops' => $workshops,
                'kids' => $kids,
                    )
            );
        }
        return $app->redirect('/');

    }

    public function validate(Application $app,$kid_id,$workshop_id){

        $workshop_has_kid = new WorkshopHasKids();
        $success = false;
        if ($app['session']->get('user')) {
            $workshop_has_kid->setValidated(1);
            $workshop_has_kid->setKidId($kid_id);
            $workshop_has_kid->setWorkshopId($workshop_id);
            $workshop_has_kid->validation();
            $success = true;
            return $app['twig']->render('ask-list.html.twig', array(
                'success' => $success,
            ));
        }

    }



    public function getWorkshopByPublicAge(Request $request,Application $app){


        if ($request->isMethod('post')){
            $age = $request->get('public_age');
            $workshop = new Workshop();
            $public_age = new PublicAge();
            $workshop_category = new WorkshopCategory();
            $establishment = new Establishment();

            $workshops = $workshop->findWorkshopByPublicAge($age);
            $ages = $public_age->findAll();
            $categories = $workshop_category->findAll();
            $establishments = $establishment->findAll();

            return $app['twig']->render('workshop.html.twig',array(
                'workshops' => $workshops,
                'ages' => $ages,
                'categories' => $categories,
                'establishments' => $establishments,
            ));

        }
    }
}