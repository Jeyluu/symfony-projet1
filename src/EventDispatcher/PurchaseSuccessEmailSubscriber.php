<?php

namespace App\EventDispatcher;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use App\Event\PurchaseSuccessEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mime\Address;

class PurchaseSuccessEmailSubscriber implements EventSubscriberInterface
{  
    protected $logger;
    protected $mailer;
    protected $security;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer, Security $security)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            "purchase.success" => "sendSuccessEmail"
        ];
    }
    public function sendSuccessEmail(PurchaseSuccessEvent $purchaseSuccessEvent)
    {
        //1.Récuperer l'utilisateur actuellement en ligne (pour connaitre son adresse)
        //Service Security
        /** @var User */
        $currentUser = $this->security->getUser();
        //2. Récuperer la commande 
        $purchase = $purchaseSuccessEvent->getPurchase();
        //3.Ecrire le mail
        $email = new TemplatedEmail();

        $email->to(new Address($currentUser->getEmail(), $currentUser->getFullName()))
            ->from("contact@mail.com")
            ->subject("Votre commande ( {$purchase->getId()} a bien été confirmée")
            ->htmlTemplate("email/purchase_success.html.twig")
            ->context([
                "purchase" => $purchase,
                "user" => $currentUser
            ]);


        //4. Envoyer l'Email
        $this->mailer->send($email);
        //mailerInterface


        $this->logger->info("Email envoyé pour la commande N°" . $purchaseSuccessEvent->getPurchase()->getId());
    }
}