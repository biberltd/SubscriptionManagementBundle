<?php
namespace BiberLtd\Bundle\SubscriptionManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscription_package", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     */
    private $subscriber_count;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $current_price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $price_update_date;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $last_price;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     */
    private $query_credit;

    /**
     * 
     */
    private $subscriberCount;

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
    private $currentPrice;

    /**
     * 
     */
    private $priceUpdateDate;

    /**
     * 
     */
    private $lastPrice;

    /**
     * 
     */
    private $queryCredit;
}