<?php
/**
 * @author		Can Berkol
 * @author		Özge Deniz Uysal
 *
 * @copyright   Biber Ltd. (http://www.biberltd.com) (C) 2015
 * @license     GPLv3
 */
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="package", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
 */
class Package extends \BiberLtd\Bundle\CoreBundle\CoreEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $fee;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $type;

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id){
        if(!$this->setModified('id', $id)->isModified()){
            return $this;
        }
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code){
        if(!$this->setModified('code', $code)->isModified()){
            return $this;
        }
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFee(){
        return $this->fee;
    }

    /**
     * @param $fee
     *
     * @return $this
     */
    public function setFee($fee){
        if(!$this->setModified('fee', $fee)->isModified()){
            return $this;
        }
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type){
        if(!$this->setModified('type', $type)->isModified()){
            return $this;
        }
        $this->type = $type;

        return $this;
    }


}