<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="packages", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
 */
class Packages
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
     * 
     */
    private $package_code;

    /**
     * 
     */
    private $package_fee;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $type;
}