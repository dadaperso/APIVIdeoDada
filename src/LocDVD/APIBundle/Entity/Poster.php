<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poster
 *
 * @ORM\Table(name="poster", uniqueConstraints={@ORM\UniqueConstraint(name="poster_umapper", columns={"mapper_id"}), @ORM\UniqueConstraint(name="poster_ukey", columns={"id", "lo_oid"})})
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\PosterRepository")
 */
class Poster
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="poster_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="lo_oid", type="integer", nullable=false)
     */
    private $loOid;

    /**
     * @var string
     */
    private $poster;

    /**
     * @var string
     *
     * @ORM\Column(name="md5", type="text", nullable=false)
     */
    private $md5;

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
     * @var Mapper
     *
     * @ORM\ManyToOne(targetEntity="Mapper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapper_id", referencedColumnName="id")
     * })
     */
    private $mapper;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLoOid()
    {
       return $this->loOid;
    }

    /**
     * @return string
     */
    public function getPoster()
    {
        ;
    }



    /**
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return \DateTime
     */
    public function getModifyDate()
    {
        return $this->modifyDate;
    }

    /**
     * @return Mapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param int $loOid
     */
    public function setLoOid($loOid)
    {
        $this->loOid = $loOid;
    }

    /**
     * @param string $md5
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
    }

    /**
     * @param \DateTime $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @param \DateTime $modifyDate
     */
    public function setModifyDate($modifyDate)
    {
        $this->modifyDate = $modifyDate;
    }

    /**
     * @param Mapper $mapper
     */
    public function setMapper($mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
        return $this;
    }


}
