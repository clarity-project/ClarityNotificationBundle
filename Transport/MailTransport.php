<?php

namespace Clarity\NotificationBundle\Transport;

use Symfony\Component\Templating\EngineInterface;
use Clarity\NotificationBundle\Message\MessageInterface;
use Clarity\NotificationBundle\Message\Type\MailType;
use Clarity\NotificationBundle\Message\Header\UnstructuredHeader;

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
    public function send(MessageInterface $message)
    {
        if (!$this->isSupported($message)) {
            return false;
        }
        if ($message->getData() instanceof \Swift_Message) {
            $this->mailer->send($message->getData());
        } else {
            $data = $message->getData();
            $message = \Swift_Message::newInstance()
                ->setSubject($data['subject'])
                ->setFrom($data['from'])
                ->setTo($data['to'])
                ->setBody($data['body'])
            ;

            // replace subject object because of \r\n problem
            $subject = $message->getHeaders()->get('subject');
            $header = new UnstructuredHeader(
                'Subject', $subject->getEncoder(), $subject->getGrammar()
            );
            $header->setValue($data['subject']);
            $message->getHeaders()->set($header);

            $this->mailer->send($message);
        }

        return;
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(MessageInterface $message)
    {
        return (false === array_search($message->getName(), $this->supported)) ? false : true;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'mail';
    }
}