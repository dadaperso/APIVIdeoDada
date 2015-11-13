<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gnere
 *
 * @ORM\Table(name="gnere", uniqueConstraints={@ORM\UniqueConstraint(name="gnere_mapper_ukey", columns={"gnere", "mapper_id"})}, indexes={@ORM\Index(name="gnere_idx", columns={"gnere"}), @ORM\Index(name="IDX_58045B18B9CA839A", columns={"mapper_id"})})
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\GnereRepository")
 */
class Gnere
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="gnere_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gnere", type="string", length=255, nullable=false)
     */
    private $gnere;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="timestamp", nullable=true)
     */
    private $createDate = 'now()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modify_date", type="timestamp", nullable=true)
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
