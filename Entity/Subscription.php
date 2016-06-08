<?php
namespace BiberLtd\Bundle\SubscriptionManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscription", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", length=255, nullable=true)
     */
    private $date_added;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_updated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_removed;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $current_status;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $current_amount;

    /**
     * 
     */
    private $dateAdded;

    /**
     * 
     */
    private $dateUpdated;

    /**
     * 
     */
    private $dateRemoved;

    /**
     * 
     */
    private $currentStatus;

    /**
     * 
     */
    private $currentAmount;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $cycle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cycle_start_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cycle_update_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cycle_next_start_date;

    /**
     * 
     */
    private $cycleStartDate;

    /**
     * 
     */
    private $cycleUpdateDate;

    /**
     * 
     */
    private $cycleNextStartDate;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", onDelete="CASCADE")
     */
    private $member;

    /**
     * 
     */
    private $package;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $instructions;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $subscription_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tracked_member;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tracking_confirmation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancellation_date;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $cancelling_side;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $cancellation_reason;

    /**
     * 
     */
    private $subscriptionDate;

    /**
     * 
     */
    private $trackedMember;

    /**
     * 
     */
    private $trackingConfirmationDate;

    /**
     * 
     */
    private $cancellationDate;

    /**
     * 
     */
    private $cancellingSide;

    /**
     * 
     */
    private $cancellationReason;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $alias;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $auto_renew;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $daily_reminder;

    /**
     * 
     */
    private $subscription_package_id;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\SubscriptionManagementBundle\Entity\SubscriptionPackage")
     * @ORM\JoinColumn(name="subscription", referencedColumnName="id", onDelete="CASCADE")
     */
    private $subscriptionPackage;
}