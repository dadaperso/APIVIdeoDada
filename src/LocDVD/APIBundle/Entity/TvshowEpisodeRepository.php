<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 24/10/2015
 * Time: 14:48
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class TvshowEpisodeRepository extends EntityRepository
{

    public function getTvZodByActor($actorName)
    {
        $qb = $this->createQueryBuilder('tvZod');

        $this->queryActorName($qb, $actorName);

        return $qb->getQuery()->getResult();
    }

    private function queryActorName(QueryBuilder $qb, $actorName)
    {
        $qb->innerJoin('LocDVDAPIBundle:Actor', 'act', 'WITH', $qb->expr()->andX(
            $qb->expr()->eq('tvZod.mapper', 'act.mapper'),
            $qb->expr()->eq('act.actor', ':name')
        )
        )
            ->setParameter('name', $actorName)
            ->innerJoin('tvZod.tvshow', 'tv')
            ->innerJoin('tvZod.mapper', 'map');
    }

}