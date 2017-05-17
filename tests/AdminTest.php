<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 17/05/2017
 * Time: 09:56
 */

namespace tests;


use simplonkids\model\Admin;

class AdminTest extends Setup
{
    public $admin;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->admin = new Admin($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testLogin()
    {

        $actual = $this->admin->login('admin');
        $expected = $admin =
            array('id' => '1','username' => 'admin','password' => 'd033e22ae348aeb5660fc2140aec35850c4da997','roles' => 'admin')
        ;
        $this->assertEquals($expected,$actual);

    }

}