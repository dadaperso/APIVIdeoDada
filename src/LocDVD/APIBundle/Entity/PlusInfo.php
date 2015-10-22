<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlusInfo
 *
 * @ORM\Table(name="plus_info", uniqueConstraints={@ORM\UniqueConstraint(name="plus_info_umapper", columns={"mapper_id"})})
 * @ORM\Entity
 */
class PlusInfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="plus_info_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="plus_info", type="text", nullable=false)
     */
    private $plusInfo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=true)
     */
    private $createDate = 'now()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modify_date", type="datetime", nullable=true)
     */
    private $modifyDate = 'now()';

    /**
     * @var \Mapper
     *
     * @ORM\ManyToOne(targetEntity="Mapper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapper_id", referencedColumnName="id")
     * })
     */
    private $mapper;


}
