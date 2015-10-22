<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WatchStatus
 *
 * @ORM\Table(name="watch_status", uniqueConstraints={@ORM\UniqueConstraint(name="watch_status_ukey", columns={"uid", "video_file_id", "mapper_id"})}, indexes={@ORM\Index(name="IDX_3C409980B9CA839A", columns={"mapper_id"}), @ORM\Index(name="IDX_3C409980762690C1", columns={"video_file_id"})})
 * @ORM\Entity
 */
class WatchStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="watch_status_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="bigint", nullable=false)
     */
    private $uid;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

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
     * @var \Mapper
     *
     * @ORM\ManyToOne(targetEntity="Mapper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapper_id", referencedColumnName="id")
     * })
     */
    private $mapper;

    /**
     * @var \VideoFile
     *
     * @ORM\ManyToOne(targetEntity="VideoFile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="video_file_id", referencedColumnName="id")
     * })
     */
    private $videoFile;


}
