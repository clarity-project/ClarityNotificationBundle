<?php

namespace Clarity\NotificationBundle\Message\Type;

use Clarity\NotificationBundle\Message\MessageTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MailType implements MessageTypeInterface
{
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
    public function getName()
    {
        return 'mail';
    }
}