<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 09/05/2017
 * Time: 15:35
 */

namespace simplonkids\model;


use simplonkids\classes\Model;
use PDO;

class Workshop extends Model
{
    public $id;
    public $title;
    public $description;
    public $price;
    public $max_kids;
    public $image;
    public $visible;
    public $public_age_id;
    public $establishment_id;
    public $workshop_category_id;


    public function findAll()
    {
        $sql = 'SELECT * , W.id ,  WC.name AS category , E.name AS establishment FROM `workshop` W
                JOIN timetable T 
                ON  T.workshop_id = W.id
                JOIN public_age P 
                ON W.public_age_id = P.id
                JOIN establishment E 
                ON W.establishment_id = E.id
                JOIN workshop_category WC 
                ON W.workshop_category_id = WC.id
                JOIN address A
                ON E.address_id = A.id
                ';

        $stmt = $this->prepareExecute($sql, []);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function fetchAll(){
        $sql = 'SELECT * FROM workshop';
        $results = $this->prepareExecute($sql,[])->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }


    public function addWorkshop()
    {

        $sql = 'INSERT INTO workshop(title,description,price,max_kids,image,visible,public_age_id,establishment_id,workshop_category_id)
                VALUES (:title,:description,:price,:max_kids,:image,:visible,:public_age_id,:establishment_id,:workshop_category_id)';

        $arguments = [
            ':title' => $this->getTitle(),
            ':description' => $this->getDescription(),
            ':price' => $this->getPrice(),
            ':max_kids' => $this->getMaxKids(),
            ':image' => $this->getImage(),
            ':visible' => $this->getVisible(),
            ':public_age_id' => $this->getPublicAgeId(),
            ':establishment_id' => $this->getEstablishmentId(),
            ':workshop_category_id' => $this->getWorkshopCategoryId(),

        ];
        $stmt = $this->prepareExecute($sql, $arguments);

        $this->setId($this->lastId());
    }

    public function findWorkshopById($id)
    {
        $sql = 'SELECT * , W.id,  E.name AS establishment FROM workshop W 
                JOIN timetable T 
                ON  T.workshop_id = W.id
                JOIN public_age P 
                ON W.public_age_id = P.id
                JOIN establishment E 
                ON W.establishment_id = E.id
                JOIN workshop_category WC 
                ON W.workshop_category_id = WC.id
                WHERE :id = W.id';
        $arguments = [
            ':id' => $id,
        ];
        $stmt = $this->prepareExecute($sql, $arguments);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    public function editWorkshop()
    {

        $sql = 'UPDATE workshop SET 
                title = :title ,
                description = :description,
                price = :price,
                max_kids = :max_kids,
                image = :image,
                visible = :visible,
                public_age_id = :public_age_id,
                establishment_id = :establishment_id,
                workshop_category_id = :workshop_category_id
                WHERE id = :id
                ';
        $arguments = [
            ':title' => $this->getTitle(),
            ':description' => $this->getDescription(),
            ':price' => $this->getPrice(),
            ':max_kids' => $this->getMaxKids(),
            ':image' => $this->getImage(),
            ':visible' => $this->getVisible(),
            ':public_age_id' => $this->getPublicAgeId(),
            ':establishment_id' => $this->getEstablishmentId(),
            ':workshop_category_id' => $this->getWorkshopCategoryId(),
            ':id' => $this->getId(),
        ];
        $stmt = $this->prepareExecute($sql, $arguments);
        $this->setId($this->getId());
    }

    public function delete($id)
    {
        $sql = "DELETE FROM workshop WHERE id = :id";

        $arguments = [
            ':id' => $id
        ];
        $stmt = $this->prepareExecute($sql, $arguments);
    }


    public function findWorkshopByPublicAge($age) {

        $sql = 'SELECT * FROM `workshop` W
                JOIN public_age P
                ON W.public_age_id = P.id
                WHERE W.public_age_id = :age_id
                ';

        $arguments = [
            ':age_id' => $age,
        ];

        $stmt = $this->prepareExecute($sql,$arguments);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getMaxKids()
    {
        return $this->max_kids;
    }

    /**
     * @param mixed $max_kids
     */
    public function setMaxKids($max_kids)
    {
        $this->max_kids = $max_kids;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param mixed $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return mixed
     */
    public function getPublicAgeId()
    {
        return $this->public_age_id;
    }

    /**
     * @param mixed $public_age_id
     */
    public function setPublicAgeId($public_age_id)
    {
        $this->public_age_id = $public_age_id;
    }

    /**
     * @return mixed
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
    }

    /**
     * @param mixed $establishment_id
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;
    }

    /**
     * @return mixed
     */
    public function getWorkshopCategoryId()
    {
        return $this->workshop_category_id;
    }

    /**
     * @param mixed $workshop_category_id
     */
    public function setWorkshopCategoryId($workshop_category_id)
    {
        $this->workshop_category_id = $workshop_category_id;
    }


}