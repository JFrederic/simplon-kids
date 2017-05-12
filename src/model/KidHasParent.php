<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 12/05/2017
 * Time: 10:59
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class KidHasParent extends Model
{
    public $kid_id;
    public $parent_id;

    public function setKidHasParent() {
        $sql = 'INSERT INTO kid_has_parent(kid_id, parent_id) VALUES (:kid_id , :parent_id)';
        $arguments = [
            ':kid_id' => $this->getKidId(),
            ':parent_id' => $this->getParentId(),
        ];
        $stmt = $this->prepareExecute($sql,$arguments);
    }

    /**
     * @return mixed
     */
    public function getKidId()
    {
        return $this->kid_id;
    }

    /**
     * @param mixed $kid_id
     */
    public function setKidId($kid_id)
    {
        $this->kid_id = $kid_id;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }
}