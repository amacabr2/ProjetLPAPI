<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 12/11/17
 * Time: 12:50
 */

namespace UserBundle\Email;

use Symfony\Component\Templating\EngineInterface;
use UserBundle\Entity\User;

class ForgotPasswordEmail {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * ForgotPasswordEmail constructor.
     * @param \Swift_Mailer $mailer
     * @param EngineInterface $templating
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating){
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param User $user
     */
    public function sendForgotPasswordMessage(User $user): void{
        $template = 'UserBundle:email:password_resetting.email.twig';
        $from = $user->getEmail();
        $to = "admin@admin.com";
        $subject = "Réinitialisation de votre mot de passe";
        $body = $this->templating->render($template, compact('user'));
        $this->send($from, $to, $subject, $body);
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param $body
     * @internal param string $email
     */
    public function send(string $from, string $to, string $subject, $body): void {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setContentType('text/html');
        $this->mailer->send($message);
    }
}