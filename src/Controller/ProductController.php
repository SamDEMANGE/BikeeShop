<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/store", name="store_")
 */
class ProductController extends AbstractController
{

    private $client;
    private $urlAPI;

    public function __construct()
    {
        $this->client=new Client();
        $this->urlAPI='http://localhost/LP/BikeeShopAPI/public/';
    }


    /**
     * @Route("/product/list/{categorie}", name="product_list")
     * @param string $categorie
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function prodList(string $categorie, Request $request){


        if(!$request->query->get('page')){
            $page=1;
        }
        else{
            $page=$request->query->get('page');
        }

       $produit_list= $this->client->request('GET', $this->urlAPI.'produits/'.$categorie.'/'.
          $page

       );

       $count_produit=$this->client->request('GET', $this->urlAPI.'products/count/'.$categorie);

   //    $categ_list=$this->client->request('GET', 'http://localhost/LP/BikeeShopAPI/public/categories/'

     //  );

       $categ=$this->client->request('GET', $this->urlAPI.'categorie/'.$categorie

       );

       // $categs= json_decode($categ_list->getBody());

       $produits= json_decode($produit_list->getBody());

       $categname=json_decode($categ->getBody());

        $urlPage=$request->getUri();

        $pages_count=ceil(json_decode($count_produit->getBody())/3);

        $pageA=$page;


        return $this->render('store/product-list.html.twig',
            [
                'produits'=>$produits,
                'urlPage'=>$urlPage,
               // 'categs'=>$categs,
                'categA'=>$categorie,
                'categ'=>$categname,
                'pages_count'=>$pages_count,
                'pageA'=>$pageA
            ]
        );
    }

    /**
     * @param string $urlPage
     * @param string $categ
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function categList(string $urlPage, string $categ){


        $categ_list=$this->client->request('GET', $this->urlAPI.'categories/'

        );

        $categs= json_decode($categ_list->getBody());



        return $this->render('store/categsidebar.html.twig', [

            'categs'=>$categs,
            'urlPage'=>$urlPage,
            'categA'=>$categ


        ]);
    }


    /**
     * @Route("/product/{id}/details", name="product_details", requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function prodDetail(int $id, Request $request){

        $produit=$this->client->request('GET',$this->urlAPI.'produit/'.$id.'/details' );
        $produit= json_decode($produit->getBody());

        $urlPage=$request->getUri();


        return $this->render('store/product-detail.html.twig',
        [
            'produit'=>$produit,
            'urlPage'=>$urlPage,
        ]);
    }


    /**
     * @Route("/product/search", name="search")
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rechercheProduit(Request $request){
        $keyword=$request->query->get('keyword');
        $searchproduit=$this->client->request('GET',$this->urlAPI.'produit/search?keyword='.$keyword );



        $produits=json_decode($searchproduit->getBody());

        return $this->render('store/product-search.html.twig',
            [
                'keyword'=>$keyword,
                'produits'=>$produits,
            ]);


    }


}