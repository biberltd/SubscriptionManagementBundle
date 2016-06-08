<?php
namespace BiberLtd\Bundle\MemberManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="member_group",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     indexes={
 *         @ORM\Index(name="idxNMemberGroupDateAdded", columns={"date_added"}),
 *         @ORM\Index(name="idxNMemberGroupDateUpdated", columns={"date_updated"}),
 *         @ORM\Index(name="idxNMemberGroupDateRemoved", columns={"date_removed"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="idxUMemberGroupId", columns={"id"}),
 *         @ORM\UniqueConstraint(name="idxUMemberGroupCode", columns={"code"})
 *     }
 * )
 */
class MemberGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=45, nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_added;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_updated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_removed;

    /**
     * @ORM\Column(type="string", length=1, nullable=false, options={"default":"r"})
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default":0})
     */
    private $count_members;

    /**
     * @ORM\OneToMany(
     *     targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\MemberGroupLocalization",
     *     mappedBy="group"
     * )
     */
    private $localizations;

    /**
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", onDelete="CASCADE")
     */
    private $site;
}