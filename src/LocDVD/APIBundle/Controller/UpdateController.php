<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 26/10/2015
 * Time: 16:19
 */

namespace LocDVD\APIBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use LocDVD\APIBundle\Entity\ActorRepository;
use LocDVD\APIBundle\Entity\MovieRepository;
use LocDVD\APIBundle\Entity\TvshowEpisodeRepository;
use LocDVD\APIBundle\Entity\TvshowRepository;
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
        $lastUpdate = $request->get('lastUpdate', '1860-01-01 00:00:01.000001');
        $lastUpdate = new \DateTime($lastUpdate);

        $entities = $request->get('entities', array('movie', 'tvZod', 'tvshow', 'actor'));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        
        if(in_array('movie', $entities)){
            /** @var MovieRepository $movieRepo */
            $movieRepo = $em->getRepository('LocDVDAPIBundle:Movie');
            $movies = $movieRepo->getMoviesByLastUpdate($lastUpdate);
        }else{
            $movies = array();
        }


        if(in_array('tvZod', $entities)){
            /** @var TvshowEpisodeRepository $tvZods */
            $tvZodRepo = $em->getRepository('LocDVDAPIBundle:TvshowEpisode');
            $tvZods = $tvZodRepo->getTvZodByLastUpdate($lastUpdate);
        }else{
            $tvZods = array();
        }

        if(in_array('tvshow',$entities)){
            /** @var TvshowRepository $tvRepo */
            $tvRepo = $em->getRepository('LocDVDAPIBundle:Tvshow');
            $tvshows = $tvRepo->getTvShowByLastUpdate($lastUpdate);
        }else{
            $tvshows = array();
        }

        if(in_array('actor', $entities)){
            /** @var ActorRepository $actorRepo */
            $actorRepo = $em->getRepository('LocDVDAPIBundle:Actor');
            $actors = $actorRepo->getActorByLastUpdate($lastUpdate);
        }else{
            $actors = array();
        }

        return array(
            'count' => count($movies) + count($tvZods)+ count($actors)+ count($tvshows),
            'update' => array(
                'movie' => $movies,
                'tv'    => $tvshows,
                'tvZod' => $tvZods,
                'actor' => $actors
                
            ),
        );
    }

}