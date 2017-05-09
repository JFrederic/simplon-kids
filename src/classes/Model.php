<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 20/04/17
 * Time: 20:25
 */

namespace App\classes;

class Model extends Sql
{
    public $app;

    public function __construct($app)
    {
        parent::getConnection();
        $this->app = $app;
    }



}