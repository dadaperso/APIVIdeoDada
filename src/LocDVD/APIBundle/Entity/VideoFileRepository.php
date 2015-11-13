<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 24/10/2015
 * Time: 14:33
 */

namespace LocDVD\APIBundle\Entity;


class VideoFileRepository extends BaseRepository
{


    public function getVideoFileByLastUpdate($lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('vf');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('vf.createDate',':lastUpdate'),
            $qb->expr()->gte('vf.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);

        $qb->orderBy('vf.createDate', 'ASC')
            ->addOrderBy('vf.modifyDate', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}