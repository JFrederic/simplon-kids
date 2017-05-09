<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 18/04/17
 * Time: 18:32
 */

namespace App\model;
use PDO;

use App\classes\Model;

class User extends Model
{

    public function findAll(){
        $sql = 'SELECT * FROM User';

        $stmt = $this->prepareExecute($sql,[]);
        $results = $stmt->fetchAll();

        return $results;
    }
}