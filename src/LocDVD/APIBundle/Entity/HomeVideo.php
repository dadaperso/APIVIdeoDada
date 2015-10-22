<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomeVideo
 *
 * @ORM\Table(name="home_video", uniqueConstraints={@ORM\UniqueConstraint(name="home_video_ukey", columns={"library_id", "title", "record_time_utc"}), @ORM\UniqueConstraint(name="home_video_umapper", columns={"mapper_id"})}, indexes={@ORM\Index(name="home_video_title_idx", columns={"title"}), @ORM\Index(name="IDX_773D23BCFE2541D7", columns={"library_id"})})
 * @ORM\Entity
 */
class HomeVideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="home_video_id_seq", allocationSize=1, initialValue=1)
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
     * @var \DateTime
     *
     * @ORM\Column(name="record_time", type="datetime", nullable=true)
     */
    private $recordTime;

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
     * @var \DateTime
     *
     * @ORM\Column(name="record_time_utc", type="datetime", nullable=true)
     */
    private $recordTimeUtc;

    /**
     * @var string
     *
     * @ORM\Column(name="certificate", type="string", length=255, nullable=false)
     */
    private $certificate = '';

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
