<?php
/**
 * Created by PhpStorm.
 * User: trist
 * Date: 29/01/2019
 * Time: 18:55
 */

namespace App\Controller;


class BasketController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}