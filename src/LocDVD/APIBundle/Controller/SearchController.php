<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 23/10/2015
 * Time: 14:03
 */

namespace LocDVD\APIBundle\Controller;


use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use LocDVD\APIBundle\Entity\MovieRepository;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController  extends Controller{

    /**
     *
     * @return array
     * @View()
     *
     */
    public function getSearchMoviesAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var MovieRepository $movieRepo */
        $movieRepo = $em->getRepository('LocDVDAPIBundle:Movie');

        /** @var Logger $logger */
        $logger = $this->get('logger');
        $movieRepo->setLogger($logger);


        $duration = $request->get('duration', false);
        if ($duration) {
            $start = $request->get('start', 300);
            $start = new \DateTime("@$start");
            $end = (int)$request->get('end');
            $end = new \DateTime("@$end");
        }

        $sort = $request->get('sort_field', 'create');
        $sens = $request->get('sort_sens', 'DESC');

        $resolution = $request->get('resolution', false);

        $watch = $request->get('watch', false);

        $channel = $request->get('channel', null);
        $codec = $request->get('codec', null);


        $logger->addDebug('VALUE resolution: ' . $resolution);
        $logger->addDebug('VALUE watch: ' . $watch);

        if ($resolution == 'HD' && $watch === '0' && $duration) {
            $logger->addDebug('metho repo: HDMovieNotViewDuration');
            $movies = $movieRepo->getHDMovieNotViewedByDuration($start, $end, $channel, $codec, $sort, $sens);
        } elseif ($resolution == 'HD' && $sort == 'duration') {
            $logger->addDebug('metho repo: HDMovieDuration');
            $movies = $movieRepo->getHDMovieByDuration($start, $end, $channel, $codec, $sort, $sens);
        } elseif ($resolution == 'HD' && $watch === '0') {
            $logger->addDebug('metho repo: HDMovieNotView');
            $movies = $movieRepo->getHDMovieNotViewed($channel, $codec, $sort, $sens);
        } elseif ($resolution == 'HD') {
            $logger->addDebug('metho repo: HDMovie');
            $movies = $movieRepo->getHDMovie($channel, $codec, $sort, $sens);
        } elseif ($resolution == 'STD' && $watch === '0' && $duration) {
            $logger->addDebug('metho repo: StdMovieNotViewDuration');
            $movies = $movieRepo->getStandardMovieNotViewedByDuration($start, $end, $sort, $sens);
        } elseif ($resolution == 'STD' && $watch === '0') {
            $logger->addDebug('metho repo: StdMovieNotView');
            $movies = $movieRepo->getStandardMovieNotViewed($sort, $sens);
        } elseif ($resolution == 'STD') {
            $logger->addDebug('metho repo: StdMovie');
            $movies = $movieRepo->getStandardMovie($sort, $sens);
        } else {
            $logger->addDebug('metho repo: HDMovieNotView');
            $movies = $movieRepo->findAll();
        }


        return array(
            'count' => count($movies),
            'movies' => $movies
        );
    }

    /**
     *  GET Route annotation.
     * @Get("/search/movies/actor")
     * @param Request $request
     * @return array
     */
    public function getSearchMovieActorAction(Request $request)
    {
        $actorName = $request->get('name');

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var MovieRepository $movieRepo */
        $movieRepo = $em->getRepository('LocDVDAPIBundle:Movie');

        $movies = $movieRepo->getMoviesByActor($actorName);

        return array(
            'count' => count($movies),
            'movies' => $movies,
        );
    }

    /**
     * @Get("/search/actor")
     * @param Request $request
     * @return array
     */
    public function getSearchActorAction(Request $request)
    {
        $actorName = $request->get('name');

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var MovieRepository $movieRepo */
        $movieRepo = $em->getRepository('LocDVDAPIBundle:Movie');

        $movies = $movieRepo->getMoviesByActor($actorName);

        $tvZodRepo = $em->getRepository('LocDVDAPIBundle:TvshowEpisode');
        $tvZods = $tvZodRepo->getTvZodByActor($actorName);

        $videos = array_merge($movies, $tvZods);

        return array(
            'count' => count($videos),
            'videos' => $videos
        );
    }
}