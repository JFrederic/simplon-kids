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
use simplonkids\model\PublicAge;
use simplonkids\model\Timetable;
use simplonkids\model\Workshop;
use simplonkids\model\WorkshopCategory;
use Symfony\Component\HttpFoundation\Request;

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

            $workshop_param = [
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'max_kids' => $max_kids,
                'image' => $image,
                'visible' => (boolean) $visible,
                'public_age_id' => $public_age_id,
                'establishment_id' => $establishment_id,
                'workshop_category_id' => $workshop_category_id,
            ];
            $workshop_id = $workshop->addWorkshop($workshop_param);

            $timetable_param = [
                'startAt' => $start,
                'endAt' => $end,
                'workshop_id' => $workshop_id,
            ];

            $timetable->addTimetable($timetable_param);
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

        if ($request->isMethod("put")){

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

            $workshop_param = [
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'max_kids' => $max_kids,
                'image' => $image,
                'visible' =>  $visible,
                'public_age_id' => $public_age_id,
                'establishment_id' => $establishment_id,
                'workshop_category_id' => $workshop_category_id,
            ];

            $workshop->setWorkshop($workshop_param,$id);

            $timetable_param = [
                'startAt' => $start,
                'endAt' => $end,
                'workshop_id' => $id,
            ];

            $timetable->setTimetable($timetable_param);

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