<?php
/**
 * Created by PhpStorm.
 * User: dada
 * Date: 23/10/2015
 * Time: 19:07
 */

namespace LocDVD\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/movies.json'),
            array('/movies/17.json'),
            array('/search/movies.json'),
            array('/search/movies.json?resolution=HD&watch=0&duration=1&end=4500'),
            array('/search/movies.json?resolution=HD&watch=0'),
            array('/search/movies.json?resolution=HD'),
            array('/search/movies.json?resolution=STD&watch=0&duration=1&end=4500'),
            array('/search/movies.json?resolution=STD&watch=0'),
            array('/search/movies.json?resolution=STD'),
        );
    }

}