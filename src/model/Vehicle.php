<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 26/04/17
 * Time: 11:58
 */

namespace App\model;
use PDO;

use App\classes\Model;

class Vehicle extends Model
{
    public function findAll()
    {

        $sql = 'SELECT * ,M.name as modele, B.name as marque
            FROM Vehicle V
            JOIN Model M
            ON V.model_id = M.id_model
            JOIN Brand B
            ON M.brand_id = B.id_brand';

        $stmt = $this->prepareExecute($sql,[]);
        $vehicles = $stmt->fetch(PDO::FETCH_ASSOC);

        return $vehicles;
    }
}