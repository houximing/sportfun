<?php

namespace SportFunBundle\Controller;

use SportFunBundle\Entity\Stadium;
use SportFunBundle\Entity\StadiumTennis;
use SportFunBundle\Entity\TennisCourt;
use SportFunBundle\Entity\User;
use SportFunBundle\Form\Admin\AdminStadiumType;
use SportFunBundle\Form\Admin\AdminTennisCourtType;
use SportFunBundle\Form\StadiumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 * @package SportFunBundle\Controller
 * @Route("/manage")
 */
class AdminController extends Controller
{
    /**
     * @Route("/order")
     * @Template()
     */
    public function orderAction()
    {
        return array(
                // ...
            );
    }

    /**
     * @Route("/stadium")
     * @Template()
     */
    public function stadiumAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $stadiums = $user->getStadiums();
        $groupStadiums = [];
        foreach($stadiums as $stadium){
            $groupStadiums[$stadium->getType()][] = $stadium;
        }
        return array(
               'keymap'   => Stadium::getTypeMap(),
               'stadiums' => $groupStadiums
            );
    }


    /**
     * @Route("/stadium-details/{id}",name="stadium-details")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function stadiumDetailsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Stadium $stadium */
        $stadium = $em->find("SportFunBundle:Stadium",$id);
        $stadiumEditForm = $this->createForm(new AdminStadiumType(), $stadium, array(
            'method' => 'POST'
        ));

        if ( $request->getMethod() == 'POST') {
            $stadiumEditForm->handleRequest($request);
            if ($stadiumEditForm->isValid()) {
                $em->persist($stadium);
                $em->flush();
            }
        }
        if($stadium instanceof StadiumTennis){
            return new Response($this->renderView('SportFunBundle:Admin:stadiumTennisDetails.html.twig',
                ['stadium' => $stadium ,
                 'form' => $stadiumEditForm->createView()]));
        }
    }

    /**
     * @Route("/stadium-add/{type}",name="stadium-add")
     * @Method("GET")
     * @Template()
     */
    public function stadiumAddAction($type)
    {
        return ['a'=>$type];
    }

    /**
     * @Route("/court-details/{id}",name="court-details")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function courtDetailsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $court = $em->find("SportFunBundle:TennisCourt",$id);
        $courtEditForm = $this->createForm(new AdminTennisCourtType(), $court, array(
            'method' => 'POST'
        ));
        if ( $request->getMethod() == 'POST') {
            $courtEditForm->handleRequest($request);
            if ($courtEditForm->isValid()) {
                $em->flush();
            }
        }
        return new Response($this->renderView('SportFunBundle:Admin:tennisCourt.html.twig',['court' => $court, 'form'=>$courtEditForm->createView()]));
    }



    /**
     * @Route("/court-add/{id}",name="court-add")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function courtAddAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $court = new TennisCourt();
        $stadium = $em->find("SportFunBundle:Stadium",$id);
        $courtEditForm = $this->createForm(new AdminTennisCourtType(), $court, array(
            'method' => 'POST'
        ));
        if ( $request->getMethod() == 'POST') {
            $courtEditForm->handleRequest($request);
            if ($courtEditForm->isValid()) {
                $court->setStadium($stadium);
                $em->persist($court);
                $em->flush();
            }
        }
        return new Response($this->renderView('SportFunBundle:Admin:tennisCourt.html.twig',['court' => $court, 'form'=>$courtEditForm->createView()]));
    }

    /**
     * @Route("/hirepad",name="hirepad")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function hirepadAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('stadiumid');
            /** @var StadiumTennis $stadium */
            $stadium = $em->find("SportFunBundle:Stadium", $id);
            if ($request->get('hirepad')) {
                $hirePrice = $request->get('hirePrice');
                $stadium->setHirepad(true);
                $stadium->setHirepadPrice($hirePrice);
            } else {
                $stadium->setHirepad(false);
                $stadium->setHirepadPrice(0);
            }
            $em->persist($stadium);
            $em->flush();
            return new JsonResponse(['Success' => "OK"]);
        }
    }
}
