<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 11:21
 */

namespace simplonkids\model;


use simplonkids\classes\Model;
use PDO;

class Establishment extends Model
{
    public function findAll() {
        $sql = 'SELECT * ,E.id as id FROM establishment E
                JOIN address A
                ON E.address_id = A.id
                ';

        $stmt = $this->prepareExecute($sql,[]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

}