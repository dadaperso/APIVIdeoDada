<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;


class MovieRepository extends EntityRepository
{

    public function getQueryHDMovies(QueryBuilder $qb)
    {
        $qb->select('mov')
            ->from('LocDVDAPIBundle:VideoFile', 'v')
            ->where($qb->expr()->gt('v.resolutionx', ':resolx'))
                ->setParameter('resolx',1200)
            ->orWhere($qb->expr()->like('v.path', ':hd'))
                ->setParameter('hd', '%720p%')
            ->orWhere($qb->expr()->like('v.path', ':fullhd'))
                ->setParameter('fullhd', '%1080p%')
            ->orderBy('mov.title', 'ASC')
        ;

        $qb->leftJoin('v.mapper', 'map', 'WITH', $qb->expr()->eq('map.type',':type'))
            ->setParameter('type', 'movie')
        ;

        $qb->leftJoin('LocDVDAPIBundle:Movie', 'mov', 'WITH', 'v.mapper = mov.mapper')
            ->select('mov')
        ;

        return $qb;
    }

    public function getHDMovieNotViewed()
    {
        /** @var \Doctrine\ORM\QueryBuilder $qb */
        $qb = $this->_em->createQueryBuilder();

        $this->getQueryHDMovies($qb);

        $qb->andWhere($qb->expr()->notIn('mov.mapper', $this->queryNotViewed()->getDQL()));

        return $qb->getQuery()->getResult();
    }

    public function queryNotViewed()
    {
        $in = $this->_em->createQueryBuilder();
        $in->select('identity(w.mapper)')
            ->from('LocDVDAPIBundle:WatchStatus','w')
            ->where('w.position >= vid.duration')
            ->leftJoin('LocDVDAPIBundle:VideoFile', 'vid', 'WITH', 'vid.mapper = w.mapper')

        ;

        return $in;
    }

}