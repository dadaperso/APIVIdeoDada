<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 23/12/2015
 * Time: 19:04
 */

namespace LocDVD\APIBundle\Entity;


use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;

class PosterRepository extends EntityRepository
{

    public function getPoster($oid)
    {
        //TODO check good run
        $connection = $this->_em->getConnection();
        $database = pg_connect("host=".$connection->getHost()." port=5432 dbname=".$connection->getDatabase()." user=postgres");

        $stat = pg_connection_status($database);
        if ($stat !== PGSQL_CONNECTION_OK) {
            return null;
        }

        ob_start();
        pg_query($database, "begin");
        $handle = pg_lo_open($database, $oid, "r");
        pg_lo_read_all($handle);
        pg_query($database, "commit");

        $imgContent = ob_get_contents();

        ob_end_clean();

        return $imgContent;
    }

    public function getPosterByLastId($lastUpdate)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('p');

        //$qb->addSelect($this->getPoster('p.loOid'));

        $qb->where($qb->expr()->orX(
            $qb->expr()->gte('p.createDate',':lastUpdate'),
            $qb->expr()->gte('p.modifyDate',':lastUpdate')
        ))
            ->setParameter('lastUpdate', $lastUpdate);

        $qb->orderBy('p.createDate', 'ASC')
            ->addOrderBy('p.modifyDate', 'ASC')
        ;

        $result = $qb->getQuery()->getResult();

        return $result ;
    }

    public function getCountAll()
    {
        $qb = $this->createQueryBuilder('e');

        $qb->select("COUNT(e.id)");

        return $qb->getQuery()->getSingleScalarResult();
    }
}