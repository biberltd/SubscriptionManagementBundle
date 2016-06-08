<?php
namespace BiberLtd\Bundle\MemberManagementBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="member_group_localization",
 *     options={"charset":"utf8","collate":"utf8_turkish_ci","engine":"innodb"},
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="idxUMemberGroupLocalization", columns={"member_group","language"}),
 *         @ORM\UniqueConstraint(name="idxUMemberGroupLocalizationUrlKey", columns={"language","url_key"})
 *     }
 * )
 */
class MemberGroupLocalization
{
    /**
     * @ORM\Column(type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=55, nullable=false)
     */
    private $url_key;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(
     *     targetEntity="BiberLtd\Bundle\MemberManagementBundle\Entity\MemberGroup",
     *     inversedBy="localizations"
     * )
     * @ORM\JoinColumn(name="member_group", referencedColumnName="id", nullable=false)
     */
    private $group;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language", referencedColumnName="id", nullable=false)
     */
    private $language;
}