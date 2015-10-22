<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Actor
 *
 * @ORM\Table(name="actor", uniqueConstraints={@ORM\UniqueConstraint(name="actor_mapper_ukey", columns={"actor", "mapper_id"})}, indexes={@ORM\Index(name="actor_idx", columns={"actor"}), @ORM\Index(name="IDX_447556F9B9CA839A", columns={"mapper_id"})})
 * @ORM\Entity
 */
class Actor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="actor_id_seq", allocationSize=1, initialValue=1)
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="actor", type="string", length=255, nullable=false)
     */
    private $actor;

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
