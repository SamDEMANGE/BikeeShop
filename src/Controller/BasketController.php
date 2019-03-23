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

    private $client;
    private $urlAPI;

    public function __construct()
    {
        $this->client=new Client();
        $this->urlAPI='http://localhost/LP/BikeeShopAPI/public/';
    }


    /**
     * @Route("/basket", name="basket")
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {

        $panier_list=$this->client->request('GET', $this->urlAPI.'panier');

        $panier=json_decode($panier_list->getBody());

        $total_panier=$this->client->request('GET', $this->urlAPI.'panier/total');

        $prix_panier=json_decode($total_panier->getBody());

        return $this->render('store/basket.html.twig', [

            'produits'=>$panier,
            'prix_total'=>$prix_panier,
        ]);
    }


    /**
     * @Route("/suppr_panier/{id}", name="suppr_article_panier")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function supprArticle(int $id){

        $panier_list=$this->client->request('DELETE', $this->urlAPI.'suppr_panier/'.$id);


        return $this->redirectToRoute('basket');


    }

    /**
     * @Route("/edit_panier", name="edit_panier")
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validerCommande(Request $request){

        $nom=$request->request->get('nom');
        $prenom=$request->request->get('prenom');
        $email=$request->request->get('email');


        if($nom == '' || $prenom == '' || $email == ''){
            $this->addFlash('danger', 'Désolé, votre commande n\'a pas été effectuée car un ou plusieurs champs sont
             vides !');


        }
        else {
            $form=$this->client->request('POST', $this->urlAPI.'panier/edit?nom='.$nom.'&prenom='.$prenom.'&email='.$email);
            $this->addFlash('success', 'Merci, votre commande a bien été effectuée !');
        }





        return $this->redirectToRoute('valide_panier');



    }

    /**
     * @Route("/valide_panier", name="valide_panier")
     */
    public function validateCommande()
    {
        return $this->render('store/validate-commande.html.twig', [



        ]);
    }





}

