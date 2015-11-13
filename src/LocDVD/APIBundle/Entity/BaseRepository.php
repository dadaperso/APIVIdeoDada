<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 13/11/2015
 * Time: 16:58
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class BaseRepository extends EntityRepository
{
    public function getEntitiesByLastUpdate($entity, $lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->_em->createQueryBuilder();

        $qb->select('e')
            ->from($entity,'e');

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('e.createDate',':lastUpdate'),
            $qb->expr()->gte('e.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);

        $qb->orderBy('e.createDate', 'ASC')
            ->addOrderBy('e.modifyDate', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getCountAll()
    {
        $qb = $this->createQueryBuilder('e');

        $qb->select("COUNT(e.id)");

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getMissingEntities(array $IDs)
    {
        $qb = $this->createQueryBuilder('e');

        $qb->where($qb->expr()->notIn('e.id',':ids'))
            ->setParameter('ids', $IDs);

        return $qb->getQuery()->getResult();
    }

    public function getAllId()
    {
        $qb = $this->createQueryBuilder('e');

        $qb->select('m.id')
           ->orderBy('m.id', 'ASC')
        ;

        $result = $qb->getQuery()->getScalarResult();
        $lisIds = array();

        foreach($result as $row){
            $lisIds[]=$row['id'];
        }

        return $lisIds;
    }
}