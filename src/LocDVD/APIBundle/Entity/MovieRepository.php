<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MovieRepository extends EntityRepository
{
	
	public function getAllMoviesWithActors($limit)
	{
		$qb = $this->createQueryBuilder('m')
				->orderBy("m.title","ASC")
				->setMaxResults($limit)
		;
		
		$qb->innerJoin("LocDVD\APIBundle\Entity\Actor", "a")
			->select('a')
		;
		
		return $qb
			->getQuery()
			->getResult()
		;
	}
}