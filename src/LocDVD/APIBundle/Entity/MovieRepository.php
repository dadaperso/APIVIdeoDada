<?php

namespace LocDVD\APIBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpKernel\Log\LoggerInterface;


class MovieRepository extends EntityRepository
{

    /** @var  LoggerInterface $logger */
    private $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getStandardMovie($order = 'create', $sens = 'DESC')
    {
        $qb = $this->queryStandardMovie();

        $this->queryOrderField($qb, $order, $sens);

        return $qb->getQuery()->getResult();
    }

    private function queryStandardMovie()
    {
        $qb = $this->_em->createQueryBuilder();

        $qb
            ->from('LocDVDAPIBundle:VideoFile', 'v')
            ->where($qb->expr()->lt('v.resolutionx', ':resolx'))
            ->setParameter('resolx', 1200);

        $qb->innerJoin('LocDVDAPIBundle:Movie', 'mov', 'WITH', 'v.mapper = mov.mapper')
            ->select('mov');

        return $qb;
    }

    private function queryOrderField(QueryBuilder $qb, $field, $sens = 'ASC')
    {
        $this->logger->debug('VALUE field: ' . $field);
        switch ($field) {
            case 'duration':
                $fieldName = 'v.duration';
                break;
            case 'title':
                $fieldName = 'mov.title';
                break;
            case 'create':
                $fieldName = 'v.createDate';
                break;
            default:
                $fieldName = null;
        }

        $this->logger->debug('VALUE fieldName: ' . $fieldName);
        if (!is_null($fieldName))
            $qb->orderBy($fieldName, $sens);

        return $qb;
    }

    public function getStandardMovieNotViewed($order = 'title', $sens = 'ASC')
    {
        $qb = $this->queryStandardMovie();

        $this->queryNotViewed();

        $this->queryOrderField($qb, $order, $sens);

        return $qb->getQuery()->getResult();
    }

    private function queryNotViewed()
    {
        $in = $this->_em->createQueryBuilder();
        $in->select('identity(w.mapper)')
            ->from('LocDVDAPIBundle:WatchStatus', 'w')
            ->where('w.position >= vid.duration')
            ->leftJoin('LocDVDAPIBundle:VideoFile', 'vid', 'WITH', 'vid.mapper = w.mapper');

        return $in;
    }

    public function getStandardMovieNotViewedByDuration($start, $end, $order, $sens)
    {
        $qb = $this->queryStandardMovie();

        $this->queryNotViewed();

        $this->queryDuration($qb, $start, $end);

        $this->queryOrderField($qb, $order, $sens);

        return $qb->getQuery()->getResult();
    }

    private function queryDuration(QueryBuilder $qb, \DateTime $start, \DateTime $end)
    {
        $qb->andWhere($qb->expr()->between('v.duration', ':start', ':end'))
            ->setParameter('start', $start->getTimestamp())
            ->setParameter('end', $end->getTimestamp());

        return $qb;
    }

    public function getHDMovie($channel, $codec, $order = 'create', $sens = 'DESC')
    {
        $qb = $this->queryHDMovies();

        $this->queryAudio($qb, $channel, $codec);

        $this->queryOrderField($qb, $order, $sens);

        return $qb->getQuery()->getResult();
    }

    private function queryHDMovies()
    {
        $qb = $this->_em->createQueryBuilder();

        $qb
            ->from('LocDVDAPIBundle:VideoFile', 'v')
            ->where($qb->expr()->gt('v.resolutionx', ':resolx'))
            ->setParameter('resolx', 1200)
            ->orWhere($qb->expr()->like('v.path', ':hd'))
            ->setParameter('hd', '%720p%')
            ->orWhere($qb->expr()->like('v.path', ':fullhd'))
            ->setParameter('fullhd', '%1080p%');

        $qb->innerJoin('LocDVDAPIBundle:Movie', 'mov', 'WITH', 'v.mapper = mov.mapper')
            ->select('mov');

        return $qb;
    }

    private function queryAudio(QueryBuilder $qb, $channel, $codec)
    {
        if ($codec) {
            $qb->andWhere($qb->expr()->eq('v.audioCodec', ':codec'))
                ->setParameter('codec', $codec);
        }

        if ($channel) {
            $qb->andWhere($qb->expr()->eq('v.channel', ':channel'))
                ->setParameter('channel', $channel);
        }

        return $qb;
    }

    public function getHDMovieByDuration($channel, $codec, $start, $end)
    {
        $qb = $this->queryHDMovies();

        $this->queryDuration($qb, $start, $end);

        $this->queryAudio($qb, $channel, $codec);

        $this->queryOrderField($qb, 'duration', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getHDMovieNotViewedByDuration($channel, $codec, $start, $end, $order, $sens)
    {
        $qb = $this->queryHDMovies();

        $this->queryNotViewed();

        $this->queryDuration($qb, $start, $end);

        $this->queryAudio($qb, $channel, $codec);

        $this->queryOrderField($qb, $order, $sens);

        return $qb->getQuery()->getResult();
    }

    public function getMoviesByActor($actorName)
    {
        $qb = $this->createQueryBuilder('mov');

        $this->queryActorName($qb, $actorName);

        return $qb->getQuery()->getResult();
    }

    private function queryActorName(QueryBuilder $qb, $actorName)
    {
        $qb->innerJoin('LocDVDAPIBundle:Actor', 'act', 'WITH', $qb->expr()->andX(
            $qb->expr()->eq('mov.mapper', 'act.mapper'),
            $qb->expr()->eq('act.actor', ':name')
        )
        )
            ->setParameter('name', $actorName);

        return $qb;
    }

    public function getMovieByKeyword($keyword)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('mov');

        $this->queryKeyWord($qb, $keyword);

        return $qb->getQuery()->getResult();

    }

    private function queryKeyWord(QueryBuilder $qb, $keyword)
    {
        // Actor filter
        $qb->innerJoin('LocDVDAPIBundle:Actor', 'act', 'WITH', $qb->expr()->eq('mov.mapper', 'act.mapper'));

        // Summary filter
        $qb->innerJoin('LocDVDAPIBundle:Summary', 'summary', 'WITH', $qb->expr()->eq('mov.mapper', 'summary.mapper'));

        // Title filter
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->like('mov.title', ':keyword'),
            $qb->expr()->like('summary.summary', ':keyword'),
            $qb->expr()->like('act.actor', ':keyword')
        )
        )->setParameter('keyword', '%' . $keyword . '%');

        return $qb;

    }

    public function getHDMovieNotViewed($channel, $codec, $order = 'create', $sens = 'DESC')
    {
        $qb = $this->queryHDMovies();

        $qb->andWhere($qb->expr()->notIn('mov.mapper', $this->queryNotViewed()->getDQL()));

        $this->queryAudio($qb, $channel, $codec);

        $this->logger->debug('VALUE field in HDNotView : ' . $order);
        $this->queryOrderField($qb, $order, $sens);

        return $qb->getQuery()->getResult();
    }

}