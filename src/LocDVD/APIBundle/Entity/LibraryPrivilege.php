<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LibraryPrivilege
 *
 * @ORM\Table(name="library_privilege", uniqueConstraints={@ORM\UniqueConstraint(name="privilege_ukey", columns={"uid", "library_id"})}, indexes={@ORM\Index(name="library_privilege_idx", columns={"uid"}), @ORM\Index(name="IDX_9DDCED0BFE2541D7", columns={"library_id"})})
 * @ORM\Entity
 */
class LibraryPrivilege
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="library_privilege_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="bigint", nullable=false)
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

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
