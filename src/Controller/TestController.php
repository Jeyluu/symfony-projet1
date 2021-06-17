<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class TestController
{
    // /**
    //  * @Route("/",name="index")
    //  */
    // public function index()
    // {
    //     dd("ca fonctionne");
    // }

    // /**
    //  * @Route("/test/{age<\d+>?0}", name="test", methods={"GET","POST"}, host = "localhost" , schemes = {"http", "https"})
    //  */
    // public function test($age) //Le paramètre $age doit s'appeller exactement pareil que dans le fichier route.yaml. C'est un argument resolver.
    // {
    //     return new Response("Vous avez $age ans");
    // }



    /**
     * @Route("/", name="main")
     */
    public function main()
    {
        return new Response("Page d'accueil");
    }

    /**
     * @Route("/hello/{prenom?world}", name="tab1")
     */
    public function tab1($prenom, LoggerInterface $logger, Calculator $calculator)
    {
        $logger->info("Mon message de log");

        $tva = $calculator->calcul(100);

        dump($tva);

        return new Response("Hello $prenom !");
    }
}
