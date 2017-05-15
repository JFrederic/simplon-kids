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
    public $address;
    public $complement;
    public $city;
    public $zipcode;



    public function addAddress() {
        $sql = 'INSERT INTO address(address, complement, city, zipcode) VALUES(:address,:complement,:city,:zipcode)';
        $arguments = [
            ':address' => $this->getAddress(),
            ':complement' => $this->getComplement(),
            ':city' => $this->getCity(),
            ':zipcode' => $this->getZipcode(),
        ];

        $stmt = $this->prepareExecute($sql,$arguments);

        $this->setId($this->lastId());
    }

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

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

}