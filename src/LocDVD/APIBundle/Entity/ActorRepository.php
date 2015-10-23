<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ActorRepository extends EntityRepository 
{
	function getActorByMapper(Mapper $mapper) {
		
		$qb = $this->createQueryBuilder('a');
		
		$qb
			->where($qb->expr()->eq('a.mapper', ':mapper'))
			->setParameter('mapper', $mapper->getId())
		;
		
		
		return $qb
			->getQuery()
			->getResult()
		;
	}
}