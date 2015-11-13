<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 26/10/2015
 * Time: 16:51
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class TvshowRepository extends EntityRepository
{

    public function getTvShowByLastUpdate(\DateTime $lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('tv');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('tv.createDate',':lastUpdate'),
            $qb->expr()->gte('tv.modifyDate',':lastUpdate')
        ))
        ->setParameter('lastUpdate', $lastUpdate);

        $qb->orderBy('tv.createDate', 'ASC')
            ->addOrderBy('tv.modifyDate', 'ASC')
        ;


        return $qb->getQuery()->getResult();
    }

    public function getCountAll()
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(tv.id)")
            ->from("LocDVDAPIBundle:Tvshow", 'tv');

        return $qb->getQuery()->getSingleScalarResult();
    }

}