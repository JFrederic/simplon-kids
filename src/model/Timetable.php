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

    public $id;
    public $startAt;
    public $endAt;
    public $enable;
    public $workshop_id;

    public function addTimetable(){
        $sql = 'INSERT INTO timetable(startAt, endAt, enable, workshop_id) 
                VALUES ( :startAt , :endAt , :enable ,:workshop_id)
                ';

        $startAt =  strtr($this->getStartAt(), '/', '-');
        $endAt =  strtr($this->getEndAt(), '/', '-');
        $arguments = [
            ':startAt' => date('Y-m-d H:i:s',strtotime($startAt)),
            ':endAt' => date('Y-m-d H:i:s',strtotime($endAt)),
            ':enable' => 0,
            ':workshop_id' => $this->getWorkshopId(),
        ];
        $stmt = $this->prepareExecute($sql,$arguments);
        $this->setId($this->lastId());
    }

    public function fetchAll() {
        $sql = 'SELECT * FROM timetable';
        return $this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function editTimetable(){
        $sql = 'UPDATE timetable SET
                startAt = :startAt,
                endAt = :endAt,
                enable = :enable,
                workshop_id = :workshop_id
                WHERE :workshop_id = workshop_id
                ';
        $startAt =  strtr($this->getStartAt(), '/', '-');
        $endAt =  strtr($this->getEndAt(), '/', '-');
        $arguments = [
            ':startAt' => date('Y-m-d H:i:s',strtotime($startAt)),
            ':endAt' => date('Y-m-d H:i:s',strtotime($endAt)),
            ':enable' => 0,
            ':workshop_id' => $this->getWorkshopId(),
        ];

        $stmt = $this->prepareExecute($sql,$arguments);
        $this->setId($this->getId());
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
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @param mixed $startAt
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @return mixed
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param mixed $endAt
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param mixed $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return mixed
     */
    public function getWorkshopId()
    {
        return $this->workshop_id;
    }

    /**
     * @param mixed $workshop_id
     */
    public function setWorkshopId($workshop_id)
    {
        $this->workshop_id = $workshop_id;
    }
}