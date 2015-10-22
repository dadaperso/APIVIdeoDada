<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Writer
 *
 * @ORM\Table(name="writer", uniqueConstraints={@ORM\UniqueConstraint(name="writer_mapper_ukey", columns={"writer", "mapper_id"})}, indexes={@ORM\Index(name="writer_idx", columns={"writer"}), @ORM\Index(name="IDX_97A0D882B9CA839A", columns={"mapper_id"})})
 * @ORM\Entity
 */
class Writer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="writer_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="writer", type="string", length=255, nullable=false)
     */
    private $writer;

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
