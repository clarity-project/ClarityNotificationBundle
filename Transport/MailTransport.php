<?php

namespace Clarity\NotificationBundle\Transport;

use Symfony\Component\Templating\EngineInterface;
use Clarity\NotificationBundle\Message\Type\MessageTypeInterface;
use Clarity\NotificationBundle\Message\Type\MailType;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MailTransport implements TransportInterface
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    private $templating;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Swift_Mailer $mailer
     */
    public function __construct(EngineInterface $templating, \Swift_Mailer $mailer)
    {
        $this->templating   = $templating;
        $this->mailer       = $mailer;
    }

    /**
     * {@inheritDoc}
     */
    public function notify(MessageTypeInterface $message)
    {
        if (!$this->isSupported($message)) {
            return false;
        }

        $message->setTemplating($this->templating);

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