<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mapper
 *
 * @ORM\Table(name="mapper")
 * @ORM\Entity(repositoryClass="LocDVD\APIBundle\Entity\MapperRepository")
 */
class Mapper
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mapper_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;
    
    
	public function getId() {
		return $this->id;
	}
	public function getType() {
		return $this->type;
	}
	
    
    


}
