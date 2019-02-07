<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/store", name="store_")
 */
class ProductController extends AbstractController
{

    /**
     * @Route("/product/list", name="product_list")
     */
    public function prodList(){

        return $this->render('store/product-list.html.twig');
    }

    /**
     * @Route("/product/details", name="product_details")
     */
    public function prodDetail(){

        return $this->render('store/product-detail.html.twig');
    }


}