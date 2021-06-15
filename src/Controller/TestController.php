<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    public function index()
    {
        dd("ca fonctionne");
    }

    /**
     * @Route("/test/{age<\d+>?0}", name="test", methods={"GET","POST"}, host = "localhost" , schemes = {"http", "https"})
     */
    public function test($age) //Le paramètre $age doit s'appeller exactement pareil que dans le fichier route.yaml. C'est un argument resolver.
    {
        return new Response("Vous avez $age ans");
    }
}
