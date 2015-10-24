<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tvshow
 *
 * @ORM\Table(name="tvshow", uniqueConstraints={@ORM\UniqueConstraint(name="tvshow_umapper", columns={"mapper_id"}), @ORM\UniqueConstraint(name="tvshow_ukey", columns={"library_id", "title", "year"})}, indexes={@ORM\Index(name="tvshow_title_idx", columns={"title"}), @ORM\Index(name="IDX_44A9FD06FE2541D7", columns={"library_id"})})
 * @ORM\Entity
 */
class Tvshow
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tvshow_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="sort_title", type="string", length=255, nullable=false)
     */
    private $sortTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="originally_available", type="date", nullable=true)
     */
    private $originallyAvailable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sort_time", type="date", nullable=true)
     */
    private $sortTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="islock", type="boolean", nullable=true)
     */
    private $islock;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="timestamp", nullable=true)
     */
    private $createDate = 'now()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modify_date", type="timestamp", nullable=true)
     */
    private $modifyDate = 'now()';

    /**
     * @var \Library
     *
     * @ORM\ManyToOne(targetEntity="Library")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="library_id", referencedColumnName="id")
     * })
     */
    private $library;

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
