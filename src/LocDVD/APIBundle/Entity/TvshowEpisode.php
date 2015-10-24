<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TvshowEpisode
 *
 * @ORM\Table(name="tvshow_episode", uniqueConstraints={@ORM\UniqueConstraint(name="tvshow_episode_umapper", columns={"mapper_id"}), @ORM\UniqueConstraint(name="tvshow_episode_ukey", columns={"season", "episode", "tvshow_id"})}, indexes={@ORM\Index(name="IDX_F9441196FE2541D7", columns={"library_id"}), @ORM\Index(name="IDX_F94411966CD43D7A", columns={"tvshow_id"})})
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\TvshowEpisodeRepository")
 */
class TvshowEpisode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tvshow_episode_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_line", type="string", length=255, nullable=false)
     */
    private $tagLine;

    /**
     * @var integer
     *
     * @ORM\Column(name="season", type="integer", nullable=true)
     */
    private $season;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode", type="integer", nullable=true)
     */
    private $episode;

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

    /**
     * @var \Tvshow
     *
     * @ORM\ManyToOne(targetEntity="Tvshow")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tvshow_id", referencedColumnName="id")
     * })
     */
    private $tvshow;


}
