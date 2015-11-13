<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 24/10/2015
 * Time: 14:48
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\ORM\QueryBuilder;

class TvshowEpisodeRepository extends BaseRepository
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

    public function getTvZodByKeyword($keyword)
    {
        $qb = $this->createQueryBuilder('tvZod');

        $this->queryKeyword($qb, $keyword);

        return $qb->getQuery()->getResult();
    }

    private function queryKeyword(QueryBuilder $qb, $keyword)
    {
        // Actor filter
        $qb->innerJoin('LocDVDAPIBundle:Actor', 'act', 'WITH',
            $qb->expr()->eq('act.mapper', 'tvZod.mapper')
        );

        // Summary filter
        $qb->innerJoin('LocDVDAPIBundle:Summary', 'summary', 'WITH',
            $qb->expr()->eq('tvZod.mapper', 'summary.mapper')
        );

        // Title Tvshow filter
        $qb->innerJoin('tvZod.tvshow', 'tv');

        // Title TvZod filter
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->like('tvZod.tagLine', ':keyword'),
            $qb->expr()->like('summary.summary', ':keyword'),
            $qb->expr()->like('tv.title', ':keyword'),
            $qb->expr()->like('act.actor', ':keyword')
        )
        );

        $qb->setParameter('keyword', '%' . $keyword . '%');

        return $qb;
    }

    public function getTvZodByLastUpdate(\DateTime $lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('tvZod');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('tvZod.createDate',':lastUpdate'),
            $qb->expr()->gte('tvZod.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);


        return $qb->getQuery()->getResult();
    }

    public function getCountAll()
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(zod.id)")
            ->from("LocDVDAPIBundle:TvshowEpisode", 'zod');

        return $qb->getQuery()->getSingleScalarResult();
    }

}