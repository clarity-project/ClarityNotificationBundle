<?php

namespace Clarity\NotificationBundle\Transport;

use Symfony\Component\Templating\EngineInterface;
use Clarity\NotificationBundle\Message\MessageInterface;
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
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param array $supported
     * @return self
     */
    public function setSupported(array $supported)
    {
        $this->supported = $supported;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function notify(MessageInterface $message)
    {
        if (!$this->isSupported($message)) {
            return false;
        }

        // return $this->mailer->send($message->build());
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(MessageInterface $message)
    {
        return (boolean) array_search($message->getName(), $this->supported);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'mail';
    }
}