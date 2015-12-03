<?php

namespace SportFunBundle\Controller;

use SportFunBundle\Entity\Stadium;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DomCrawler\Crawler;

class DefaultController extends Controller
{
    /**
     * @Route("/sport/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $html = "http://www.chemistwarehouse.com.au/search?searchtext=Banana%20Boat%20SPF%2050+%20Everyday%20100g%20Tube&searchmode=allwords";
        $ch = curl_init($html);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $crawloer = new Crawler($result);

        $products = $crawloer->filter(".Product");
        foreach($products as $product){
            $crawler1 = new Crawler();
            $crawler1->add($product);
            $productName = $crawler1->filter('a')->attr('title');
            $price = $crawler1->filter('.Price')->text();

            return [
                'productName' => $productName,
                'price' => $price
            ];

        }

    }
}
