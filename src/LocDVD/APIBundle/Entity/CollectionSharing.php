<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionSharing
 *
 * @ORM\Table(name="collection_sharing", uniqueConstraints={@ORM\UniqueConstraint(name="sharing_ukey", columns={"collection_id"})})
 * @ORM\Entity
 */
class CollectionSharing
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="collection_sharing_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="avail_date", type="date", nullable=false)
     */
    private $availDate = '1970-01-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exp_date", type="date", nullable=false)
     */
    private $expDate = '1970-01-01';

    /**
     * @var boolean
     *
     * @ORM\Column(name="permanent", type="boolean", nullable=false)
     */
    private $permanent = true;

    /**
     * @var \Collection
     *
     * @ORM\ManyToOne(targetEntity="Collection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collection_id", referencedColumnName="id")
     * })
     */
    private $collection;


}
