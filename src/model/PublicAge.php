<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 11:08
 */

namespace simplonkids\model;


use simplonkids\classes\Model;
use PDO;

class PublicAge extends Model
{

    public function findAll() {
        $sql = 'SELECT * FROM public_age';

        $stmt = $this->prepareExecute($sql,[]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}