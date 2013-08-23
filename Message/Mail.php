<?php

namespace Clarity\NotificationBundle\Message;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Mail implements MessageInterface
{   
    /**
     * @var \Symfony\Component\OptionsResolver\OptionsResolverInterface
     */
    private $resolver;

    /**
     * @var array
     */
    private $options;

    /**
     * 
     */
    public function __construct()
    {
        $this->resolver = new OptionsResolver();
        $this->resolver->setRequired(array(
            'subject', 'name', 'from', 'to', 'message_template', 'message_arguments'
        ));
        $this->options = array();
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritDoc}
     */
    public function resolveOptions(array $options)
    {
        $this->options = $this->resolver->resolve($options);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(array $options)
    {
        $this->resolver->setDefaults($options);
    }

    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $options = $this->resolver->resolve($this->options);

        \Swift_Message::newInstance()
            ->setSubject($options['subject'])
            ->setFrom(array($options['from'] => $options['name']))
            ->setTo($options['to'])
            ->setBody($this->renderView($options['message_template'], $options['message_arguments'])
        );
    }
}