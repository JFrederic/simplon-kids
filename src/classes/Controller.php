<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 26/04/17
 * Time: 11:36
 */

namespace App\classes;


class Controller
{
    public $data = array();

    public function __construct($data)
    {
        $this->data = $data;
    }
}