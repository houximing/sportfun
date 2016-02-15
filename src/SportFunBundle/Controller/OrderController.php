<?php

namespace SportFunBundle\Controller;

use SportFunBundle\Entity\Booking;
use SportFunBundle\Entity\BookingOrderItem;
use SportFunBundle\Entity\Stadium;
use SportFunBundle\Entity\StadiumTennis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/billingDetails", name="billing-details")
     * @Template()
     */
    public function billingDetailsAction(Request $request)
    {
        $order = new Booking();

        $data = $request->request;
        $em = $this->getDoctrine()->getManager();
        $stadium = $em->find('SportFunBundle\Entity\Stadium', $data->get('stadiumId'));
        if($stadium instanceof StadiumTennis){
            $courtData = $data->get('sportfunbundle_stadiumtennis');
            $numberOfPeople = $courtData['court']['maxpeople'];
            $unitCourtTotalPrice = 0;
            $numberOfCourt = 0;
            foreach ($stadium->getCourts() as $court){
                if($data->get('court-check-' . $court->getId())){
                    $unitCourtTotalPrice += $data->get('court-check-' . $court->getId());
                    $numberOfCourt ++;
                }
            }
            $additionalPeople = $courtData['court']['addition'];
            $hiredPadPrice = 0;
            if($stadium->getHirepad()){
                $hiredPadPrice = $courtData['hirepad'] * $stadium->getHirepadPrice();
            }
            $price = $unitCourtTotalPrice * $additionalPeople + $hiredPadPrice + ($numberOfPeople + $additionalPeople) * $stadium->getUnitPrice();
            $order->setDatetimeCreated(new \DateTime('now', new \DateTimeZone('Australia/Melbourne')));
            $order->setTotal($price);
            $orderItemPeople = new BookingOrderItem();
            $orderItemPeople->setName("Number of People");
            $orderItemPeople->setQuantity($numberOfPeople + $additionalPeople);
            $orderItemPeople->setType(BookingOrderItem::TYPE_ALL);

            $orderItemPad = new BookingOrderItem();
            $orderItemPad->setName("Number of Pad");
            $orderItemPad->setQuantity($courtData['hirepad']);
            $orderItemPad->setType(BookingOrderItem::TYPE_ALL);

            $orderItemCourt = new BookingOrderItem();
            $orderItemCourt->setName("Number of court");
            $orderItemCourt->setQuantity($numberOfCourt);
            $orderItemCourt->setType(BookingOrderItem::TYPE_ALL);

            $order->addBookingOrderItem($orderItemPeople);
            $order->addBookingOrderItem($orderItemPad);
            $order->addBookingOrderItem($orderItemCourt);
        }

        //Credit card form section

        return [
            'order' => $order,

        ];
    }

    /**
     * @Route("/payment")
     * @Template()
     */
    public function paymentAction()
    {
        return [];
    }

}
