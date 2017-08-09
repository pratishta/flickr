<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction($count)
    {
        $numbers = array();
        for ($i = 0; $i< $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

//        $html = $this->container->get('templating')->render(
//            'lucky/number.html.twig',
//            array('luckyNumberList' => $numbersList)
//        );


       // return new Response($html);
        return $this -> render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numbersList)
        );
        //return $this->redirect('https://www.google.com/');
    }




}