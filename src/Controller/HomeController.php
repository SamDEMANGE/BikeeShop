<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/01/2019
 * Time: 18:37
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("", name="")
 */

class HomeController extends AbstractController
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