<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Movie
 *
 * @ORM\Table(name="movie", uniqueConstraints={@ORM\UniqueConstraint(name="movie_ukey", columns={"library_id", "title", "year"}), @ORM\UniqueConstraint(name="movie_umapper", columns={"mapper_id"})}, indexes={@ORM\Index(name="movie_title_idx", columns={"title"}), @ORM\Index(name="IDX_1D5EF26FFE2541D7", columns={"library_id"})})
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\MovieRepository")
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="movie_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="tag_line", type="string", length=255, nullable=false)
     */
    private $tagLine;

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
     * 
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
     * 
     * @var ArrayCollection
     * 
     * @ORM\ManyToOne(targetEntity="Actor", inversedBy="mapper_id")
     */
    private $actor;
    
    public function __construct()
    {
    	$this->actor = new ArrayCollection();
    }
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getSortTitle() {
		return $this->sortTitle;
	}
	public function setSortTitle($sortTitle) {
		$this->sortTitle = $sortTitle;
		return $this;
	}
	public function getTagLine() {
		return $this->tagLine;
	}
	public function setTagLine($tagLine) {
		$this->tagLine = $tagLine;
		return $this;
	}
	public function getYear() {
		return $this->year;
	}
	public function setYear($year) {
		$this->year = $year;
		return $this;
	}
	public function getOriginallyAvailable() {
		return $this->originallyAvailable;
	}
	public function setOriginallyAvailable(\DateTime $originallyAvailable) {
		$this->originallyAvailable = $originallyAvailable;
		return $this;
	}
	public function getSortTime() {
		return $this->sortTime;
	}
	public function setSortTime(\DateTime $sortTime) {
		$this->sortTime = $sortTime;
		return $this;
	}
	public function getIslock() {
		return $this->islock;
	}
	public function setIslock($islock) {
		$this->islock = $islock;
		return $this;
	}
	public function getCreateDate() {
		return $this->createDate;
	}
	public function setCreateDate(\DateTime $createDate) {
		$this->createDate = $createDate;
		return $this;
	}
	public function getModifyDate() {
		return $this->modifyDate;
	}
	public function setModifyDate(\DateTime $modifyDate) {
		$this->modifyDate = $modifyDate;
		return $this;
	}
	public function getCertificate() {
		return $this->certificate;
	}
	public function setCertificate($certificate) {
		$this->certificate = $certificate;
		return $this;
	}
	public function getLibrary() {
		return $this->library;
	}
	public function setLibrary(Library $library) {
		$this->library = $library;
		return $this;
	}
	public function getMapper() {
		return $this->mapper;
	}
	public function setMapper(Mapper $mapper) {
		$this->mapper = $mapper;
		return $this;
	}
	
	public function getActors() {
		return $this->actor;
	}
	
	public function addActor(Actor $actor) {
		$this->actor->add($actor);
	}
		
	public function setActors(ArrayCollection $actors) {
		$this->actor = $actors;
	}
	
	


}
