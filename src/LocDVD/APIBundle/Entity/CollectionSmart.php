<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionSmart
 *
 * @ORM\Table(name="collection_smart")
 * @ORM\Entity
 */
class CollectionSmart
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=16, nullable=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_default_library", type="boolean", nullable=false)
     */
    private $hasDefaultLibrary = true;

    /**
     * @var string
     *
     * @ORM\Column(name="filter", type="text", nullable=false)
     */
    private $filter;

    /**
     * @var \Collection
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Collection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collection_id", referencedColumnName="id")
     * })
     */
    private $collection;


}
