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

class BasketController extends AbstractController
{
    /**
     * @Route("/Basket", name="Basket")
     */
    public function index()
    {
        return $this->render('store/basket.html.twig', [
            'controller_name' => 'BasketController',
        ]);
    }

}