<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FlickrController extends HomeController
{
    /**
     * @Route("/flickr/{startDate}")
     */
    public function getPhotoAction($startDate)
    {
        $startDateUpdated = substr($startDate, 0, 10);
        // $endDateUpdated = substr($endDate, 0, 10);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.flickr.com/services/rest/?method=flickr.interestingness.getList&api_key=bce6a5153199d7ab52d017e628b2fea1&date='.$startDateUpdated.'&per_page=5&page=1&format=json&nojsoncallback=1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $json = json_decode($data);
        $photos = $json->photos;
        $photoArray = $photos->photo;


        $html = '<html><body>';
        for ($i = 0; $i < count($photoArray); $i++) {
            $jsonPhoto = $photoArray[$i];
            $url = '<img src="https://farm'.
                $jsonPhoto->farm.
                '.staticflickr.com/'.
                $jsonPhoto->server.
                '/'.
                $jsonPhoto->id.
                '_'.
                $jsonPhoto->secret.
                '.jpg">';
            $html .= $url;
        }
        $html .= '</body></html>';

        //print_r ($html);


        return new Response(
            $html
        );

    }
}