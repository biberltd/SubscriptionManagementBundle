<?php
namespace BiberLtd\Bundle\MemberManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="members_of_group",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     indexes={
 *         @ORM\Index(name="idxNMembersOfGroupDateAdded", columns={"date_added"}),
 *         @ORM\Index(name="idxNMembersOfGroupDateUpdated", columns={"date_updated"}),
 *         @ORM\Index(name="idxNMembersOfGroupDateRemoved", columns={"date_removed"})
 *     },
 *     uniqueConstraints={@ORM\UniqueConstraint(name="idxUMembersOfGroup", columns={"member","member_group"})}
 * )
 */
class MembersOfGroup
{
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
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $member;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\MemberGroup")
     * @ORM\JoinColumn(name="member_group", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $group;
}