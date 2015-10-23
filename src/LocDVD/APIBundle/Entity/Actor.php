<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Actor
 *
 * @ORM\Table(name="actor", uniqueConstraints={@ORM\UniqueConstraint(name="actor_mapper_ukey", columns={"actor", "mapper_id"})}, indexes={@ORM\Index(name="actor_idx", columns={"actor"}), @ORM\Index(name="IDX_447556F9B9CA839A", columns={"mapper_id"})})
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\ActorRepository")
 */
class Actor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="actor_id_seq", allocationSize=1, initialValue=1)
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="actor", type="string", length=255, nullable=false)
     */
    private $actor;

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
     * @var \Mapper
     *
     * @ORM\ManyToOne(targetEntity="Mapper")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapper_id", referencedColumnName="id")
     * })
     */
    private $mapper;
    

    private $movies;

    private $tvShows;

    public function __construct()
    {
    	$this->movies =new ArrayCollection();
    }
    
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getActor() {
		return $this->actor;
	}
	public function setActor($actor) {
		$this->actor = $actor;
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
	public function getMapper() {
		return $this->mapper;
	}
	public function setMapper(Mapper $mapper) {
		$this->mapper = $mapper;
		return $this;
	}
	public function getMovies() {
		return $this->movies;
	}
	public function setMovies(ArrayCollection $movies) {
		$this->movies = $movies;
		return $this;
	}
	
	public function addMovie(Movie $movie)
	{
		$this->movies->add($movie);
	}

    public function getTvShows() {
        return $this->tvShows;
    }
    public function setTvShow($tvShow) {
        $this->tvShows = $tvShow;
        return $this;
    }

    public function addTvShows(Tvshow $tvShow)
    {
        $this->tvShows[] = $tvShow;
    }
	
    
    
    


}
