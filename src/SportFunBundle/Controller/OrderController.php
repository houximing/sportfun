<?php

namespace SportFunBundle\Controller;

use SportFunBundle\Entity\Booking;
use SportFunBundle\Entity\BookingOrderItem;
use SportFunBundle\Entity\CreditCard;
use SportFunBundle\Entity\Stadium;
use SportFunBundle\Entity\StadiumTennis;
use SportFunBundle\Form\AddressType;
use SportFunBundle\Form\Addressype;
use SportFunBundle\Form\CreditCardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{

    /**
     * @Route("/billingDetails", name="billing-details")
     * @Template()
     */
    public function billingDetailsAction(Request $request)
    {
        $order = new Booking();
        $user = $this->getUser();
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
            $order->setUser($user);
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
            $order->setStatus(Booking::STATUS_AWAITING);
        }
        $em->persist($order);
        $em->flush();
        //Credit card form section
        $creditCard = new CreditCard();
        $ccForm = $this->createForm(new CreditCardType(), $creditCard, [
            'method' => 'POST',
            'action' => $this->generateUrl('payment')
        ]);
        $addressForm = $this->createForm(new AddressType());
        return [
            'order' => $order,
            'user' => $user,
            'ccForm' => $ccForm->createView(),
            'addressForm' => $addressForm->createView()
        ];
    }

    /**
     * @Route("/payment", name="payment")
     * @Method("POST")
     * @Template()
     */
    public function paymentAction(Request $request)
    {
        //update order status
        $address = $request->request->get('sportfunbundle_address');
        $creditcard = $request->request->get('sportfunbundle_creditcard');
        $em = $this->getDoctrine()->getManager();
        $state = $em->find('SportFunBundle:State',$address['state']);
        /** @var Booking $order */
        $order = $em->find('SportFunBundle:Booking', $request->request->get('order_id'));
        $order->setStatus(Booking::STATUS_COMPLETE);
        $order->setAddress($address['address']);
        $order->setName($address['name']);
        $order->setSuburb($address['suburb']);
        $order->setState($state);
        $order->setPostcode($address['postcode']);
        $em->persist($order);
        $em->flush();
        return [];
    }

}
