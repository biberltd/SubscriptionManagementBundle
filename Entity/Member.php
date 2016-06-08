<?php
namespace BiberLtd\Bundle\MemberManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="member",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     indexes={
 *         @ORM\Index(name="idxNFullNameOfMember", columns={"name_first","name_last","first_name","last_name"}),
 *         @ORM\Index(name="idxNMemberDateRegitration", columns={"date_registration"}),
 *         @ORM\Index(name="idxNMemberDateBirth", columns={"date_birth","dateBirth"}),
 *         @ORM\Index(name="idxNMemberDateActivation", columns={"date_activation"}),
 *         @ORM\Index(name="idxNMemberDateStatusChanged", columns={"date_status_changed"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="idxUMemberId", columns={"id"}),
 *         @ORM\UniqueConstraint(name="idxUMemberUsername", columns={"username","site"}),
 *         @ORM\UniqueConstraint(name="idxUMemberEmail", columns={"email","site"})
 *     }
 * )
 */
class Member
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $name_first;

    /**
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $name_last;

    /**
     * @ORM\Column(type="string", unique=true, length=255, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string", unique=true, length=155, nullable=false)
     */
    private $username;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_birth;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $file_avatar;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_registration;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_activation;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_status_changed;

    /**
     * @ORM\Column(type="string", length=1, nullable=false, options={"default":"i"})
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $key_activation;

    /**
     * @ORM\Column(type="string", length=1, nullable=true, options={"default":"f"})
     */
    private $gender;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_last_login;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $extra_info;

    /**
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $last_name;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $notification;

    /**
     * @ORM\Column(type="string", nullable=true, options={"default":"r"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $msisdn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateBirth;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fileAvatar;

    /**
     * 
     */
    private $subscription_id;

    /**
     * @ORM\OneToMany(
     *     targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\MemberLocalization",
     *     mappedBy="member"
     * )
     */
    private $localizations;

    /**
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language", referencedColumnName="id", onDelete="CASCADE")
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", onDelete="CASCADE")
     */
    private $site;

    /**
     * 
     * 
     */
    private $subscription;
}