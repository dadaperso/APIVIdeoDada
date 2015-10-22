<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poster
 *
 * @ORM\Table(name="poster", uniqueConstraints={@ORM\UniqueConstraint(name="poster_umapper", columns={"mapper_id"}), @ORM\UniqueConstraint(name="poster_ukey", columns={"id", "lo_oid"})})
 * @ORM\Entity
 */
class Poster
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="poster_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="lo_oid", type="integer", nullable=false)
     */
    private $loOid;

    /**
     * @var string
     *
     * @ORM\Column(name="md5", type="text", nullable=false)
     */
    private $md5;

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
