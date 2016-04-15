<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscription", options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"})
 */
class Subscription extends \BiberLtd\Bundle\CoreBundle\CoreEntity
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
     * @ORM\ManyToOne(targetEntity="SubscriptionPackage")
     * @ORM\JoinColumn(name="package", referencedColumnName="id", onDelete="CASCADE")
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
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $remaining_amount;

    /**
     * 
     */
    private $remain_amount;

    /**
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $member;
    
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
    public function getPrice(){
        return $this->price;
    }
    
    /**
     * @param $price
     *
     * @return $this
     */
    public function setPrice($price){
        if(!$this->setModified('price', $price)->isModified()){
            return $this;
        }
        $this->price = $price;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDateStart(){
        return $this->date_start;
    }
    
    /**
     * @param $date_start
     *
     * @return $this
     */
    public function setDateStart($date_start){
        if(!$this->setModified('date_start', $date_start)->isModified()){
            return $this;
        }
        $this->date_start = $date_start;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDateEnd(){
        return $this->date_end;
    }
    
    /**
     * @param $date_end
     *
     * @return $this
     */
    public function setDateEnd($date_end){
        if(!$this->setModified('date_end', $date_end)->isModified()){
            return $this;
        }
        $this->date_end = $date_end;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDateCancel(){
        return $this->date_cancel;
    }
    
    /**
     * @param $date_cancel
     *
     * @return $this
     */
    public function setDateCancel($date_cancel){
        if(!$this->setModified('date_cancel', $date_cancel)->isModified()){
            return $this;
        }
        $this->date_cancel = $date_cancel;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getStatus(){
        return $this->status;
    }
    
    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatus($status){
        if(!$this->setModified('status', $status)->isModified()){
            return $this;
        }
        $this->status = $status;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getPackage(){
        return $this->package;
    }
    
    /**
     * @param $package
     *
     * @return $this
     */
    public function setPackage($package){
        if(!$this->setModified('package', $package)->isModified()){
            return $this;
        }
        $this->package = $package;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getPromotion(){
        return $this->promotion;
    }
    
    /**
     * @param $promotion
     *
     * @return $this
     */
    public function setPromotion($promotion){
        if(!$this->setModified('promotion', $promotion)->isModified()){
            return $this;
        }
        $this->promotion = $promotion;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getPaymentStatus(){
        return $this->payment_status;
    }
    
    /**
     * @param $payment_status
     *
     * @return $this
     */
    public function setPaymentStatus($payment_status){
        if(!$this->setModified('payment_status', $payment_status)->isModified()){
            return $this;
        }
        $this->payment_status = $payment_status;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getRemainAmount(){
        return $this->remain_amount;
    }
    
    /**
     * @param $remain_amount
     *
     * @return $this
     */
    public function setRemainAmount($remain_amount){
        if(!$this->setModified('remain_amount', $remain_amount)->isModified()){
            return $this;
        }
        $this->remain_amount = $remain_amount;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getMember(){
        return $this->member;
    }
    
    /**
     * @param $member
     *
     * @return $this
     */
    public function setMember($member){
        if(!$this->setModified('member', $member)->isModified()){
            return $this;
        }
        $this->member = $member;
        
        return $this;
    }
    
}