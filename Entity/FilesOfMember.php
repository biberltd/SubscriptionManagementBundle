<?php
namespace BiberLtd\Bundle\MemberManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="files_of_member",
 *     options={"charset":"utf8","engine":"innodb","collate":"utf8_turkish_ci"},
 *     uniqueConstraints={@ORM\UniqueConstraint(name="idxUFilesOfMember", columns={"member","file"})}
 * )
 */
class FilesOfMember
{
    /**
     * @ORM\Column(type="integer", length=10, nullable=false, options={"default":0})
     */
    private $count_view;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\Member")
     * @ORM\JoinColumn(name="member", referencedColumnName="id", nullable=false)
     */
    private $member;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="File")
     * @ORM\JoinColumn(name="file", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $file;
}