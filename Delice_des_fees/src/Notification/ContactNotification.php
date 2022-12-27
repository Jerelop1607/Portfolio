<?php

namespace App\Notification;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\Contact;

class ContactNotification{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;

    }


public function contactNotify(Contact $mail)
{
    $email = (new Email())
    ->from('hello@example.com')
    ->to('jlopes192@gmail.com')
    ->cc('cc@example.com')
    ->bcc('bcc@example.com')
    ->replyTo('fabien@example.com')
    ->priority(Email::PRIORITY_HIGH)
    ->subject('Time for Symfony Mailer!')
    ->text('Sending emails is fun again!')
    ->html('<p>See Twig integration for better HTML integration!</p>');

    $this->mailer->send($email);

}
}
