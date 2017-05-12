<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class EstablishmentTest extends \PHPUnit\Framework\TestCase
{


    public function testFindAll()
    {
        $establishment = new \simplonkids\model\Establishment();
        $actual = $establishment->findAll(PDO::FETCH_ASSOC);
        $expected = array(
            array('id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '5','address' => '15 rue pomme','complement' => 'endroit perdus','city' => 'Bras-Panon','zipcode' => '97431','id' => '1')
        );
        $this->assertEquals($expected, $actual);
    }

}