<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 12:08
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class Address extends Model
{
    public $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function addAddress($address) {
        $sql = 'INSERT INTO address(address, complement, city, zipcode) VALUES(:address,:complement,:city,:zipcode)';
        $arguments = [
            ':address' => $address['address'],
            ':complement' => $address['complement'],
            ':city' => $address['city'],
            ':zipcode' => $address['zipcode'],
        ];

        $stmt = $this->prepareExecute($sql,$arguments);

        $this->setId($this->lastId());
    }
}