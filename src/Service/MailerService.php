<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailerService 
{
  /**
   * @Route("Route", name="RouteName")
   */
  public function __construct(private MailerInterface $mailer)
  {
      
  }
  public function sendEmail(User $user ,string $subjet="activation de compte")
  {
    $email=(new TemplatedEmail())
    ->from("dialloe1999@gmail.com")
          ->to($user->getEmail())
          ->subject($subjet)
          ->htmlTemplate("emails/email.html.twig")
          ->context([
            'subject'=>$subjet,
            'date_expiration'=>$user->getExpireAt()->format("Y-m-d H:i:s"),
            'username'=>$user->getNom(),
            'token'=>$user->getToken()
            
          ]);
          $this->mailer->send($email);
  }
}

?>