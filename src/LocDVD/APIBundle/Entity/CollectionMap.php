<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionMap
 *
 * @ORM\Table(name="collection_map", uniqueConstraints={@ORM\UniqueConstraint(name="collection_mapper_ukey", columns={"collection_id", "mapper_id"})}, indexes={@ORM\Index(name="IDX_3B2405DF514956FD", columns={"collection_id"}), @ORM\Index(name="IDX_3B2405DFB9CA839A", columns={"mapper_id"})})
 * @ORM\Entity
 */
class CollectionMap
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="collection_map_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \Collection
     *
     * @ORM\ManyToOne(targetEntity="Collection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collection_id", referencedColumnName="id")
     * })
     */
    private $collection;

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
