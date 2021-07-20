<?php

namespace App\EventDispatcher;

use App\Event\ProductViewEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class ProductViewEmailSubscriber implements EventSubscriberInterface
{

    protected $logger;
    protected $mailer;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            "product.view" => "sendEmail"
        ];
    }

    public function sendEmail(ProductViewEvent $productViewEvent)
    {
        $email = new Email();
        $email->from(new Address("contact@mail.com", "Infos de la boutique"))
            ->to("admin@mail.com")
            ->text("Un visiteur est en train de voir la page du produit n°" . $productViewEvent->getProduct()->getId())
            ->html("<h1>Visite du produit de la part du Jean</h1>")
            ->subject("Visite du produit N°" . $productViewEvent->getProduct()->getId());

        $this->mailer->send($email);

        $this->logger->info("Email envoyé à l'admin pour le produit" .  $productViewEvent->getProduct()->getId());
    }
}
