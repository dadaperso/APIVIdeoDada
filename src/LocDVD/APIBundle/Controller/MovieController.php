<?php

namespace LocDVD\APIBundle\Controller;

use Doctrine\ORM\EntityManager;
use LocDVD\APIBundle\Entity\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LocDVD\APIBundle\Entity\Movie;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use LocDVD\APIBundle\Entity\MovieRepository;


class MovieController  extends Controller
{
	/**
	 * @return array
	 * @View()
	 * 
	 */
	function getMoviesAction() 
	{
		/** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
		
		/** @var MovieRepository $movieRepo */
		$movieRepo = $em->getRepository('LocDVDAPIBundle:Movie');
		$movies = $movieRepo->findAll();
		
		return array('movies' => $movies);
	}

	/**
	 * @param Movie $movie
	 * @return array
	 * @view()
	 * @ParamConverter("movie", class="LocDVDAPIBundle:Movie")
	 */
	function getMovieAction(Movie $movie)
	{
		/** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var ActorRepository $actorRepo */
        $actorRepo = $em->getRepository('LocDVDAPIBundle:Actor');

        $actors = $actorRepo->getActorByMapper($movie->getMapper());

        $movie->setActors($actors);

        return array("movie" => $movie);
	}
}