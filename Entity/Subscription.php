<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscription", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", length=20, options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $date_start;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_end;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_cancel;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $package;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $promotion;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $payment_status;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $remain_amount;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $member;
}