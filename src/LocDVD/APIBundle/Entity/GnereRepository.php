<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 13/11/2015
 * Time: 16:12
 */

namespace LocDVD\APIBundle\Entity;


class GnereRepository extends BaseRepository{

    public function getGenreByLastUpdate(\DateTime $lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('g');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('g.createDate',':lastUpdate'),
            $qb->expr()->gte('g.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);

        $qb->orderBy('g.createDate', 'ASC')
            ->addOrderBy('g.modifyDate', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}