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
    public $id;
    public $firstname;
    public $lastname;
    public $birthday;
    public $classroom;



    public function addKid() {
        $sql = 'INSERT INTO kid(firstname, lastname, birthday, classroom) VALUES(:firstname,:lastname,:birthday,:classroom)';
        $arguments = [
            ':firstname' => $this->getFirstname(),
            ':lastname' => $this->getLastname(),
            ':birthday' => $this->getBirthday(),
            ':classroom' => $this->getClassroom(),
        ];
        $stmt = $this->prepareExecute($sql,$arguments);
        $this->setId($this->lastId());

    }

    public function findAll() {
        $sql = 'SELECT * FROM kid';
        return $this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC);
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
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * @param mixed $classroom
     */
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;
    }
}