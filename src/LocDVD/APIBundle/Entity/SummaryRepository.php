<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 29/10/2015
 * Time: 18:00
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\ORM\EntityRepository;

class SummaryRepository  extends EntityRepository{

    public function getSummaryByLastUpdate($lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('s');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('s.createDate',':lastUpdate'),
            $qb->expr()->gte('s.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);

        $qb->orderBy('s.createDate', 'ASC')
            ->addOrderBy('s.modifyDate', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}