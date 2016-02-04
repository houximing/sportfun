<?php

namespace SportFunBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class OrderController extends Controller
{
    /**
     * @Route("/fill")
     * @Template()
     */
    public function fillAction()
    {
        return [];
    }

    /**
     * @Route("/billingDetails")
     * @Template()
     */
    public function billingDetailsAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/payment")
     * @Template()
     */
    public function paymentAction()
    {
        return array(
                // ...
            );    }

}
