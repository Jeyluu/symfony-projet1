<?php

namespace App\Controller\Purchase;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchasesListController extends AbstractController
{

    /**
     *
     * @Route("/purchases", name="purchase_index")
     * @IsGranted("ROLE_USER", message="Vous etes être connecté pour accèder à vos commandes")
     */
    public function index()
    {
        // 1.Nous devons nous assurer que la personne est connectée (sinon redirection sur la page d'accueil) ->security
        /**
         * @var User
         */
        $user = $this->getUser();


        // 2.Nous voulons savoir QUI est connecté ->security

        // 3.Nous voulons passer l'utilisateur connecté à Twig afin d'afficher ses commandes.
        return $this->render("purchase/index.html.twig", [
            "purchases" => $user->getPurchases()
        ]);
    }
}
