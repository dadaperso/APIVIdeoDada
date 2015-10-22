<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Director
 *
 * @ORM\Table(name="director", uniqueConstraints={@ORM\UniqueConstraint(name="director_mapper_ukey", columns={"director", "mapper_id"})}, indexes={@ORM\Index(name="director_idx", columns={"director"}), @ORM\Index(name="IDX_1E90D3F0B9CA839A", columns={"mapper_id"})})
 * @ORM\Entity
 */
class Director
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="director_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="director", type="string", length=255, nullable=false)
     */
    private $director;

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
