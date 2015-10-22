<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionHasLibrary
 *
 * @ORM\Table(name="collection_has_library", uniqueConstraints={@ORM\UniqueConstraint(name="has_library_ukey", columns={"collection_id", "library_id"})}, indexes={@ORM\Index(name="IDX_5ADB6CE6514956FD", columns={"collection_id"}), @ORM\Index(name="IDX_5ADB6CE6FE2541D7", columns={"library_id"})})
 * @ORM\Entity
 */
class CollectionHasLibrary
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="collection_has_library_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \Library
     *
     * @ORM\ManyToOne(targetEntity="Library")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="library_id", referencedColumnName="id")
     * })
     */
    private $library;


}
