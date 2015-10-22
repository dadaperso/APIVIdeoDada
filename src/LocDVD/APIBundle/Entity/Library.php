<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Library
 *
 * @ORM\Table(name="library", uniqueConstraints={@ORM\UniqueConstraint(name="library_ukey", columns={"title"})})
 * @ORM\Entity
 */
class Library
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="library_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=false)
     */
    private $isPublic = true;


}
