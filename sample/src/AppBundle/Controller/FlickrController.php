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
    public function getPhotoAction($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $end = $end->modify('+1 day');

        $html = '<html><body>';

        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($start, $interval, $end);
        $remaining = 5;

        $imgCount = 0;
        //while ($imgCount < 5) {
            foreach ($dateRange as $dt) {
                if ($remaining <= 0) {
                    break;
                }

                $currDate = $dt->format('Y-m-d');
                $photoNum = rand(0, $remaining);
                if ($photoNum == 0) {
                    continue;
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.flickr.com/services/rest/?method=flickr.interestingness.getList&api_key=33daca6c5e9d05bd5c67387970aea802&date=' . $currDate . '&format=json&nojsoncallback=1&per_page=' . $photoNum);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $data = curl_exec($ch);
                $json = json_decode($data);
                $photos = $json->photos;
                $photoArray = $photos->photo;
                for ($i = 0; $i < count($photoArray); $i++) {
                    $jsonPhoto = $photoArray[$i];
                    $url = '<img src="https://farm' .
                        $jsonPhoto->farm .
                        '.staticflickr.com/' .
                        $jsonPhoto->server .
                        '/' .
                        $jsonPhoto->id .
                        '_' .
                        $jsonPhoto->secret .
                        '.jpg">';
                    $html .= $url;
                    $imgCount += 1;
                }
                $remaining -= $photoNum;
            }
        //}
        $html .= '</body></html>';

        //print_r ($html);


        return new Response(
            $html
        );

    }
}