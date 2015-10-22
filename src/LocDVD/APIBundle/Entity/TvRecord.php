<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TvRecord
 *
 * @ORM\Table(name="tv_record", uniqueConstraints={@ORM\UniqueConstraint(name="tv_record_ukey", columns={"title", "record_time_utc", "channel_name"}), @ORM\UniqueConstraint(name="tv_record_umapper", columns={"mapper_id"})}, indexes={@ORM\Index(name="tv_record_title_idx", columns={"title"})})
 * @ORM\Entity
 */
class TvRecord
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tv_record_id_seq", allocationSize=1, initialValue=1)
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
     * @var string
     *
     * @ORM\Column(name="channel_name", type="string", length=255, nullable=false)
     */
    private $channelName;

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
     * @var \Mapper
     *
     * @ORM\ManyToOne(targetEntity="Mapper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapper_id", referencedColumnName="id")
     * })
     */
    private $mapper;


}
