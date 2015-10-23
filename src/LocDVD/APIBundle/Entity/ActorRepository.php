<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ActorRepository extends EntityRepository 
{
	function getActorByMapper(Mapper $mapper) {
		
		$qb = $this->_em->createQueryBuilder();
		
		$qb->select('a.actor')
			->from('LocDVD\APIBundle\Entity\Actor', 'a')
			->where($qb->expr()->eq('a.mapper', ':mapper'))
			->setParameter('mapper', $mapper->getId())
		;
		
		
		return $qb
			->getQuery()
			->getArrayResult()
		;
	}
}