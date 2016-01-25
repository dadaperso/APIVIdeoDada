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
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PosterController extends FOSRestController
{
    /**
    *
    * @Get("/poster/{oid}.{_format}")
    * @param Request $request
    * @return array
    * @View()
    */

    public function getImgPosterAction(Request $request, $oid)
    {
        $dirPosterPath = $this->get('kernel')->getRootDir().'/../web/bundles/locdvdapi/images/poster/';
        $fileName = $dirPosterPath.$oid.'.jpg';
//        $fileName = $this->get('templating.helper.assets')->getUrl($dirPosterPath.'poster'.$oid.'.jpg');

        $this->get('logger')->addDebug('path to poster: '.$fileName);

        if(!file_exists($fileName)){
            $posterRepo = $this->getDoctrine()->getRepository('LocDVDAPIBundle:Poster');

            $imgPoster = $posterRepo->getPoster($oid);

            $fp = fopen($fileName, 'w');
            fwrite($fp, $imgPoster);

            fclose($fp);
        }

        header('Content-Type: image/jpeg');

       imagejpeg(imagecreatefromjpeg($fileName));
        die();

      // return $this->redirect($fileName);
    }
}