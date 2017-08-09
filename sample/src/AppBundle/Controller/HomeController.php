<?php
/**
 * Created by PhpStorm.
 * User: py2211
 * Date: 8/8/17
 * Time: 4:24 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Date;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/home")
     */
    public function homeAction(Request $request)
    {
        $date = new Date();
        $date->setStartDate(new \DateTime('tomorrow'));
        $date->setEndDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder()
            -> add('startDate', 'date')
            // -> add('endDate', 'date')
            -> add('save', 'submit', array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = $form->get('startDate')->getData();

            // $dateStamp = $date->date;
            var_dump($date);

            // logic

            return $this->redirect($this->generateUrl('flickr', array(
                'startDate' => $date->date,
            )));

        }

        return $this->render('default/home.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}