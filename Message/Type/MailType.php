<?php

namespace Clarity\NotificationBundle\Message\Type;

use Clarity\NotificationBundle\Message\MessageTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MailType implements MessageTypeInterface
{   
    /**
     * @param \Twig_Environment
     */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritDoc}
     */
    public function buildConfiguration(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array('from', 'to', 'body'));

        $resolver->setDefaults(array(
            'sender' => null,
            'body-variables' => array(),
            'cc' => array(),
            'bcc' => array(),
            'reply-to' => array(),
            'subject' => null,
            'content-type' => 'text/plain',
        ));

        $resolver->setAllowedValues(array(
            'content-type' => array('text/plain', 'text/html'),
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function build(array $configuration)
    {
        $message = \Swift_Message::newInstance($configuration['subject'])
            ->setFrom($configuration['from'])
            ->setTo($configuration['to'])
            ->setBody($this->twig->render($configuration['body'], $configuration['body-variables']))
        ;

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'mail';
    }
}