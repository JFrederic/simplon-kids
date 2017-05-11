<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 11:19
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class WorkshopCategory extends Model
{

    public function findAll() {
        $sql = 'SELECT * FROM workshop_category';

        $stmt = $this->prepareExecute($sql,[]);
        $results = $stmt->fetchAll();

        return $results;
    }
}