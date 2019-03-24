<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/01/2019
 * Time: 18:37
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;



/**
 * @Route("", name="")
 */

class HomeController extends AbstractController
{


    private $client;
    private $urlAPI;

     /**
      * @var \Swift_Mailer
      */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {

        $this->mailer = $mailer;
        $this->client=new Client();
        $this->urlAPI='http://localhost/LP/BikeeShopAPI/public/';
    }


    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation()
    {
        return $this->render('store/presentation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('store/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/mail", name="mail")du
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function envoimail(Request $request){

        $nom=$request->request->get('nom');
        $email=$request->request->get('email');
        $text=$request->request->get('message');

        $text2=$nom . "(" . $email . ") vous envoie: " . $text;

        $message = (new \Swift_Message($text2))
            ->setFrom($email)
            ->setTo('valentindechaume@gmail.com')
            ->setBody(
                $this->renderView(('email/contact.html.twig')),
                'text/html'
            );

        $this->mailer->send($message);

        $this->addFlash('success', 'Merci, votre message a été pris en compte !');

        return $this->redirectToRoute('contact');


    }

    /**
     * @Route("/", name="homepage")
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function prod_date_List(){


        $nv_prods=$this->client->request('GET', $this->urlAPI.'home/prod_date'

        );

        $prods_pop=$this->client->request('GET', $this->urlAPI.'home/prod_pop');

        $date_produits= json_decode($nv_prods->getBody());

        $pop_produits= json_decode($prods_pop->getBody());

        return $this->render('store/homepage.html.twig', [

            'date_produits'=>$date_produits,
            'pop_produits'=>$pop_produits,

        ]);
    }







}