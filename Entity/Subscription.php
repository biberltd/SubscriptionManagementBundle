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
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="decimal", nullable=true)
     * @var float
     */
    private $price;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @var \DateTime
     */
    private $date_start;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime
     */
    private $date_end;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime
     */
    private $date_cancel;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @var string
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="SubscriptionPackage")
     * @ORM\JoinColumn(name="package", referencedColumnName="id", onDelete="CASCADE")
     * @var SubscriptionPackage
     */
    private $package;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @var string
     */
    private $promotion;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @var string
     */
    private $payment_status;

    /**
     * @ORM\Column(type="decimal", nullable=false)
     * @var float
     */
    private $remaining_amount;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @var \BiberLtd\Bundle\MemberManagementBundle\Entity\Member
     */
    private $member;

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
     * @return float
     */
    public function getPrice(){
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice(float $price){
        if(!$this->setModified('price', $price)->isModified()){
            return $this;
        }
        $this->price = $price;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart(){
        return $this->date_start;
    }

    /**
     * @param \DateTime $date_start
     *
     * @return $this
     */
    public function setDateStart(\DateTime $date_start){
        if(!$this->setModified('date_start', $date_start)->isModified()){
            return $this;
        }
        $this->date_start = $date_start;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd(){
        return $this->date_end;
    }

    /**
     * @param \DateTime $date_end
     *
     * @return $this
     */
    public function setDateEnd(\DateTime $date_end){
        if(!$this->setModified('date_end', $date_end)->isModified()){
            return $this;
        }
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCancel(){
        return $this->date_cancel;
    }

    /**
     * @param \DateTime $date_cancel
     *
     * @return $this
     */
    public function setDateCancel(\DateTime $date_cancel){
        if(!$this->setModified('date_cancel', $date_cancel)->isModified()){
            return $this;
        }
        $this->date_cancel = $date_cancel;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status){
        if(!$this->setModified('status', $status)->isModified()){
            return $this;
        }
        $this->status = $status;

        return $this;
    }

    /**
     * @return \SubscriptionPackage
     */
    public function getPackage(){
        return $this->package;
    }

    /**
     * @param \SubscriptionPackage $package
     *
     * @return $this
     */
    public function setPackage(SubscriptionPackage $package){
        if(!$this->setModified('package', $package)->isModified()){
            return $this;
        }
        $this->package = $package;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotion(){
        return $this->promotion;
    }

    /**
     * @param string $promotion
     *
     * @return $this
     */
    public function setPromotion(string $promotion){
        if(!$this->setModified('promotion', $promotion)->isModified()){
            return $this;
        }
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentStatus(){
        return $this->payment_status;
    }

    /**
     * @param string $payment_status
     *
     * @return $this
     */
    public function setPaymentStatus(string $payment_status){
        if(!$this->setModified('payment_status', $payment_status)->isModified()){
            return $this;
        }
        $this->payment_status = $payment_status;

        return $this;
    }

    /**
     * @return float
     */
    public function getRemainingAmount(){
        return $this->remaining_amount;
    }

    /**
     * @param float $remaining_amount
     *
     * @return $this
     */
    public function setRemainingAmount(float $remaining_amount){
        if(!$this->setModified('remaining_amount', $remaining_amount)->isModified()){
            return $this;
        }
        $this->remaining_amount = $remaining_amount;

        return $this;
    }

    /**
     * @return \BiberLtd\Bundle\MemberManagementBundle\Entity\Member
     */
    public function getMember(){
        return $this->member;
    }

    /**
     * @param \BiberLtd\Bundle\MemberManagementBundle\Entity\Member $member
     *
     * @return $this
     */
    public function setMember(\BiberLtd\Bundle\MemberManagementBundle\Entity\Member $member){
        if(!$this->setModified('member', $member)->isModified()){
            return $this;
        }
        $this->member = $member;

        return $this;
    }

}