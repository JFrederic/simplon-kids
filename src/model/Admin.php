<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 16/05/2017
 * Time: 11:18
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class Admin extends Model
{
    public $id;
    public $username;
    protected $password;
    public $roles;


    public function login($username){
        $sql = 'SELECT * FROM admin WHERE username = :username';
        $arguments = [':username' => $username];
        $logs = $this->prepareExecute($sql,$arguments)->fetch(\PDO::FETCH_ASSOC);
        $this->setRoles($logs['roles']);
        if ($logs != null ){
            return $logs;
        }
        else{
            return false;
        }
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


}