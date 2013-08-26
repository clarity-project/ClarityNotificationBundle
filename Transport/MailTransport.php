<?php

namespace Clarity\NotificationBundle\Transport;

use Clarity\NotificationBundle\Message\Type\MessageTypeInterface;
use Clarity\NotificationBundle\Message\Type\MailType;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MailTransport implements TransportInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * {@inheritDoc}
     */
    public function notify(MessageTypeInterface $message)
    {
        return $this->mailer->send($message->build());
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(MessageTypeInterface $message)
    {
        return (bool) ($message instanceof MailType);
    }
}