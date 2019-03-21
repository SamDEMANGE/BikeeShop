<?php
/**
 * Created by PhpStorm.
 * User: trist
 * Date: 29/01/2019
 * Time: 18:55
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends AbstractController
{
    /**
     * @Route("/basket", name="basket")
     */
    public function index()
    {
        return $this->render('store/basket.html.twig', [
            'controller_name' => 'BasketController',
        ]);
    }


    /**
     * @param string $urlPage
     * @param string $categ
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function categList(string $urlPage, string $categ){


        $panier_list=$this->client->request('GET', 'http://localhost/LP/BikeeShopAPI/public/list-panier/'

        );

        $produits= json_decode($panier_list->getBody());



        return $this->render('store/basket.html.twig', [

            'produits'=>$produits,


        ]);
    }
}

