<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 07/11/2015
 * Time: 16:52
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\ORM\EntityRepository;

class MapperRepository extends EntityRepository{

    public function getMapperByLastId($lastUpdate)
    {
        $qb = $this->createQueryBuilder('map');

        $qb->where($qb->expr()->gt('map.id',':id'))
            ->setParameter('id', $lastUpdate)
        ;

        $qb->orderBy('map.id', 'ASC');

        return $qb->getQuery()->getResult();
    }
}