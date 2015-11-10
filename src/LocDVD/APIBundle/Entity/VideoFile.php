<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoFile
 *
 * @ORM\Table(name="video_file", uniqueConstraints={@ORM\UniqueConstraint(name="video_file_ukey", columns={"path"})}, indexes={@ORM\Index(name="video_file_create_date_idx", columns={"create_date"}), @ORM\Index(name="IDX_8B086BCCB9CA839A", columns={"mapper_id"})})
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\VideoFileRepository")
 */
class VideoFile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="video_file_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=4096, nullable=false)
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="filesize", type="bigint", nullable=false)
     */
    private $filesize = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="container_type", type="string", length=255, nullable=true)
     */
    private $containerType;

    /**
     * @var string
     *
     * @ORM\Column(name="video_codec", type="string", length=255, nullable=true)
     */
    private $videoCodec;

    /**
     * @var integer
     *
     * @ORM\Column(name="frame_bitrate", type="integer", nullable=true)
     */
    private $frameBitrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="frame_rate_num", type="integer", nullable=true)
     */
    private $frameRateNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="frame_rate_den", type="integer", nullable=true)
     */
    private $frameRateDen;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_bitrate", type="integer", nullable=true)
     */
    private $videoBitrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_profile", type="integer", nullable=true)
     */
    private $videoProfile;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_level", type="integer", nullable=true)
     */
    private $videoLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="resolutionx", type="integer", nullable=true)
     */
    private $resolutionx;

    /**
     * @var integer
     *
     * @ORM\Column(name="resolutiony", type="integer", nullable=true)
     */
    private $resolutiony;

    /**
     * @var string
     *
     * @ORM\Column(name="audio_codec", type="string", length=255, nullable=true)
     */
    private $audioCodec;

    /**
     * @var integer
     *
     * @ORM\Column(name="audio_bitrate", type="integer", nullable=true)
     */
    private $audioBitrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="frequency", type="integer", nullable=true)
     */
    private $frequency;

    /**
     * @var integer
     *
     * @ORM\Column(name="channel", type="integer", nullable=true)
     */
    private $channel;

    /**
     * @var string
     *
     * @ORM\Column(name="updated", type="string", length=1, nullable=true)
     */
    private $updated;

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
     * @var integer
     *
     * @ORM\Column(name="display_x", type="integer", nullable=true)
     */
    private $displayX;

    /**
     * @var integer
     *
     * @ORM\Column(name="display_y", type="integer", nullable=true)
     */
    private $displayY;

    /**
     * @var integer
     *
     * @ORM\Column(name="ff_video_profile", type="integer", nullable=false)
     */
    private $ffVideoProfile = '(-99)';

    /**
     * @var integer
     *
     * @ORM\Column(name="rotation", type="integer", nullable=false)
     */
    private $rotation = '0';

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
