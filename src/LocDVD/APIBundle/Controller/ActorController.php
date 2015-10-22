<?php

namespace LocDVD\APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LocDVD\APIBundle\Entity\Movie;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use LocDVD\APIBundle\Entity\Actor;


class ActorController  extends Controller
{
	/**
	 * @return array
	 * @View()
	 */
	function getActorsAction() 
	{
		$em = $this->getDoctrine()->getManager();
		
		$movies = $em->getRepository('LocDVDAPIBundle:Actor')->findAll();
		
		return array('actors' => $movies);
		
		;
	}
	/**
	 * @param Actor $actor
	 * @return array
	 * @view()
	 * @ParamConverter("actor", class="LocDVDAPIBundle:Actor")
	 */
	function getActorAction(Actor $actor)
	{
		return array("actor" => $actor);
	}
}