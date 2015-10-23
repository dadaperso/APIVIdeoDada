<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 23/10/2015
 * Time: 14:03
 */

namespace LocDVD\APIBundle\Controller;


use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\View;
use LocDVD\APIBundle\Entity\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController  extends Controller{

    /**
     * @return array
     * @View()
     *
     */
    public function getSearchMoviesAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var MovieRepository $movieRepo */
        $movieRepo = $em->getRepository('LocDVDAPIBundle:Movie');

        $movies = $movieRepo->getHDMovieNotViewed();

        return array('movies' => $movies);
    }

}