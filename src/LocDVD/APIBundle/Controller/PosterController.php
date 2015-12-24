<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 24/12/2015
 * Time: 11:07
 */

namespace LocDVD\APIBundle\Controller;


use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PosterController extends Controller
{
    /**
    *
    * @Get("/poster/{oid}")
    * @param Request $request
    * @return array
    * @View()
    */

    public function getImgPosterAction(Request $request, $oid)
    {
        $posterRepo = $this->getDoctrine()->getRepository('LocDVDAPIBundle:Poster');

        $imgPoster = $posterRepo->getPoster($oid);

        return array(
            'oid' => $oid,
            'imgPoster' => base64_encode($imgPoster),
        );
    }
}