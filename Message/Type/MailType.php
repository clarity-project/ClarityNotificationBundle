<?php

namespace Clarity\NotificationBundle\Message\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MailType implements MessageTypeInterface
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
     * @var \Symfony\Component\Templating\EngineInterface $templating
     */
    private $templating;

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
     * @param \Symfony\Component\Templating\EngineInterface $templating
     */
    public function setTemplating($templating)
    {
        $this->templating = $templating;
    }

    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $options = $this->resolver->resolve($this->options);

        $message = \Swift_Message::newInstance()
            ->setSubject($options['subject'])
            ->setFrom(array($options['from'] => $options['name']))
            ->setTo($options['to'])
            ->setBody($this->templating->render($options['message_template'], $options['message_arguments'])
        );

        return $message;
    }
}