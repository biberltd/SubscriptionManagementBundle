<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscription", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
 */
class Subscription
{
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
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id", nullable=false, onDelete="CASCADE", onUpdate="CASCADE")
     */
    private $member;
}