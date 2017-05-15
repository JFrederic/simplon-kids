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
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $telephone;
    public $address_id;



    public function addParent() {
        $sql = 'INSERT INTO parent(firstname, lastname, email, telephone, address_id) VALUES(:firstname,:lastname,:email,:telephone,:address_id)';
        $arguments = [
            ':firstname' => $this->getFirstname(),
            ':lastname' => $this->getLastname(),
            ':email' => $this->getEmail(),
            ':telephone' => $this->getTelephone(),
            ':address_id' => $this->getAddressId(),
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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * @param mixed $address_id
     */
    public function setAddressId($address_id)
    {
        $this->address_id = $address_id;
    }
}