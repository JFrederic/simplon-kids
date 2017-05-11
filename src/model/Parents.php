<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 11:19
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class Parents extends Model
{
    public function addParent($parent) {
        $sql = 'INSERT INTO parent(firstname, lastname, email, telephone, address_id) VALUES(:firstname,:lastname,:email,:telephone,:address_id)';
        $arguments = [
            ':firstname' => $parent['parent_lastname'],
            ':lastname' => $parent['parent_lastname'],
            ':email' => $parent['email'],
            ':telephone' => $parent['telephone'],
            ':address_id' => $parent['address_id'],
        ];

        $stmt = $this->prepareExecute($sql,$arguments);
    }
}