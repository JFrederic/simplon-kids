<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 16:10
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class Timetable extends Model {

    public function addTimetable($timetable){
        $sql = 'INSERT INTO timetable(startAt, endAt, enable, workshop_id) 
                VALUES ( :startAt , :endAt , :enable ,:workshop_id)
                ';

        $startAt =  strtr($timetable['startAt'], '/', '-');
        $endAt =  strtr($timetable['endAt'], '/', '-');
        $arguments = [
            ':startAt' => date('Y-m-d H:i:s',strtotime($startAt)),
            ':endAt' => date('Y-m-d H:i:s',strtotime($endAt)),
            ':enable' => 0,
            ':workshop_id' => $timetable['workshop_id'],
        ];
        $stmt = $this->prepareExecute($sql,$arguments);
    }

    public function setTimetable($timetable){
        $sql = 'UPDATE timetable SET
                startAt = :startAt,
                endAt = :endAt,
                enable = :enable,
                workshop_id = :workshop_id
                WHERE :workshop_id = workshop_id
                ';
        $startAt =  strtr($timetable['startAt'], '/', '-');
        $endAt =  strtr($timetable['endAt'], '/', '-');
        $arguments = [
            ':startAt' => date('Y-m-d H:i:s',strtotime($startAt)),
            ':endAt' => date('Y-m-d H:i:s',strtotime($endAt)),
            ':enable' => 0,
            ':workshop_id' => $timetable['workshop_id']
        ];

        $stmt = $this->prepareExecute($sql,$arguments);
    }
}