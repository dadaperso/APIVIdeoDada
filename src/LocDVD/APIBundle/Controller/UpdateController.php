<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 26/10/2015
 * Time: 16:19
 */

namespace LocDVD\APIBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use LocDVD\APIBundle\Entity\BaseRepository;
use Symfony\Component\HttpFoundation\Request;

class UpdateController extends FOSRestController
{

    /**
     *
     * @Get("/update/check")
     * @param Request $request
     * @return array
     * @View()
     */
    public function getUpdateCheckAction(Request $request)
    {
        $entities = $request->get('entities', array('movie', 'tvZod', 'tvshow', 'actor'));
        $em = $this->getDoctrine()->getManager();
        $result = array();

        if(!in_array('mapper', $entities) && !in_array('poster', $entities)){
            $lastUpdate = $request->get('lastUpdate', '1860-01-01 00:00:01.000001');
            $lastdate = explode(' ', $lastUpdate);
            $lastdate = explode('-', $lastdate[0]);
            $days = explode('T',$lastdate[2]);


            $lastUpdate = new \DateTime();
            $lastUpdate->setDate($lastdate[0],$lastdate[1], $days[0]);

            if(isset($days[1])){
                $time = explode(":", $days[1]);
                $lastUpdate->setTime($time[0],$time[1]);
            }
            $logger = $this->get('logger');

            $logger->addDebug($lastUpdate->format('Y-m-d'));

            foreach($entities as $entity){
                $nbAllEntities=0;
                $listEntity=array();

                $entityPath = $this->getEntityPathByTag($entity);
                $metaClass = new ClassMetadata($entityPath);
                /** @var BaseRepository $baseRepo */
                $baseRepo = new BaseRepository($em, $metaClass);
                $listEntity = $baseRepo->getEntitiesByLastUpdate($entityPath,$lastUpdate);
                $nbAllEntities = $baseRepo->getCountAll();

                $result[$entity]= array(
                    "nbTotal"   => $nbAllEntities,
                    "nbUpDate"  => count($listEntity),
                    "data"      => $listEntity,
                );
            }
        }elseif(in_array('mapper', $entities)){
            $lastUpdate = $request->get('lastUpdate',0);

            /** MapperRepository $maperRepo */
            $maperRepo = $this->getDoctrine()->getRepository('LocDVDAPIBundle:Mapper');
            $mapper = $maperRepo->getMapperByLastId($lastUpdate);
            $nbAllEntities = $maperRepo->getCountAll();

            $result['mapper']= array(
                "nbTotal"   => $nbAllEntities,
                "nbUpDate"  => count($mapper),
                "data"      => $mapper,
            );

        }elseif(in_array('poster', $entities)){
            $lastUpdate = $request->get('lastUpdate', '1860-01-01 00:00:01.000001');
            $lastdate = explode(' ', $lastUpdate);
            $lastdate = explode('-', $lastdate[0]);
            $days = explode('T',$lastdate[2]);


            $lastUpdate = new \DateTime();
            $lastUpdate->setDate($lastdate[0],$lastdate[1], $days[0]);

            if(isset($days[1])){
                $time = explode(":", $days[1]);
                $lastUpdate->setTime($time[0],$time[1]);
            }

            /** MapperRepository $maperRepo */
            $posterRepo = $this->getDoctrine()->getRepository('LocDVDAPIBundle:Poster');
            $poster = $posterRepo->getPosterByLastId($lastUpdate);
            $nbAllEntities = $posterRepo->getCountAll();

            $result['poster']= array(
                "nbTotal"   => $nbAllEntities,
                "nbUpDate"  => count($poster),
                "data"      => $poster,
            );

        }

        return $result;
    }

    /**
     * @Post("update/maj")
     * @param Request $request
     * @View()
     */
    public function putUpdateMaJAction(Request $request)
    {
        $entities = $request->get('entities');

        $IDs = $request->get('ids');

        $logger = $this->get('logger');

        $logger->addDebug('param IDs: '.print_r($IDs,true));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $result = array();

        foreach($entities as $entity){
            $listMissingEntities = array();
            $listAllEntitiesIds = array();
            $listDeleteEntities = array();

            $entityPath = $this->getEntityPathByTag($entity);
            $metaClass = new ClassMetadata($entityPath);
            /** @var BaseRepository $baseRepo */
            $baseRepo = new BaseRepository($em, $metaClass);

            $listMissingEntities = $baseRepo->getMissingEntities($IDs);
            $listAllEntitiesIds = $baseRepo->getAllId();
            $listDeleteEntities = array_diff($IDs, $listAllEntitiesIds);

            $result[$entity] = array(
                'nbMissing' => count($listMissingEntities),
                'nbDelete'  => count($listDeleteEntities),
                'data' =>array(
                    'missing'   => $listMissingEntities,
                    'delete'    => array_values($listDeleteEntities),
                ),
            );
        }

        return $result;
    }

    private function getEntityPathByTag($tag){
        switch($tag){
            case 'movie':
                $entityPath = 'LocDVDAPIBundle:Movie';
                break;
            case 'tvshow':
                $entityPath = 'LocDVDAPIBundle:Tvshow';
                break;
            case 'tvZod':
                $entityPath = 'LocDVDAPIBundle:TvshowEpisode';
                break;
            case 'mapper':
                $entityPath = 'LocDVDAPIBundle:Mapper';
                break;
            case 'actor':
                $entityPath = 'LocDVDAPIBundle:Actor';
                break;
            case 'summary':
                $entityPath = 'LocDVDAPIBundle:Summary';
                break;
            case 'video_file':
                $entityPath = 'LocDVDAPIBundle:VideoFile';
                break;
            case 'gnere':
                $entityPath = 'LocDVDAPIBundle:Gnere';
                break;
            case 'watch_status':
                $entityPath = 'LocDVDAPIBundle:WatchStatus';
                break;
            case 'poster':
                $entityPath = 'LocDVDAPIBundle:Poster';
        }

        return $entityPath;
    }

}