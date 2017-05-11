<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 11:19
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class Kid extends Model
{
    public function addKid($kid) {
        $sql = 'INSERT INTO kid(firstname, lastname, birthday, classroom) VALUES(:firstname,:lastname,:birthday,:classroom)';
        $arguments = [
            ':firstname' => $kid['kid_firstname'],
            ':lastname' => $kid['kid_lastname'],
            ':birthday' => $kid['birthday'],
            ':classroom' => $kid['classroom'],
        ];

        $stmt = $this->prepareExecute($sql,$arguments);

    }
}