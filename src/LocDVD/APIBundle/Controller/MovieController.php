<?php

namespace LocDVD\APIBundle\Controller;

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
		$em = $this->getDoctrine()->getManager();
		
		/** @var MovieRepository $movieRepo */
		$movieRepo = $em->getRepository('LocDVDAPIBundle:Movie'); 
		$movies = $movieRepo->getAllMoviesWithActors(10);
		
		return array('movies' => $movies);
		
		;
	}
	/**
	 * @param Movie $movie
	 * @return array
	 * @view()
	 * @ParamConverter("user", class="LocDVDAPIBundle:Movie")
	 */
	function getMovieAction(Movie $movie)
	{
		return array("movie" => $movie);
	}
}