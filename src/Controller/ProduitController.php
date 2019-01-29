<?php
/**
 * Created by PhpStorm.
 * User: Navid
 * Date: 29/01/2019
 * Time: 18:54
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/store", name="store_")
 */
class ProduitController extends AbstractController
{

    /**
     * @Route("/product/list", name="product_list")
     */
    public function prodList(){




        return $this->render('store/product-list.html.twig', [
            'controller'=>'controller'

        ]);
    }

}