<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 20/04/17
 * Time: 20:25
 */

namespace simplonkids\classes;

class Model extends Sql
{
    public function __construct()
    {
        parent::getConnection();
    }



}