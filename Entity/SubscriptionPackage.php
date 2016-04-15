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
class SubscriptionPackage
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
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id){
        if(!$this->setModified('id', $id)->isModified()){
            return $this;
        }
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code){
        if(!$this->setModified('code', $code)->isModified()){
            return $this;
        }
        $this->code = $code;

        return $this;
    }

    /**
     * @return float
     */
    public function getFee(){
        return $this->fee;
    }

    /**
     * @param float $fee
     *
     * @return $this
     */
    public function setFee(float $fee){
        if(!$this->setModified('fee', $fee)->isModified()){
            return $this;
        }
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type){
        if(!$this->setModified('type', $type)->isModified()){
            return $this;
        }
        $this->type = $type;

        return $this;
    }



}