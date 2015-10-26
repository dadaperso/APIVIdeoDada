<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

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

    public function getActorByLastUpdate(\DateTime $lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('a');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('a.createDate',':lastUpdate'),
            $qb->expr()->gte('a.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);


        return $qb->getQuery()->getArrayResult();
    }
}