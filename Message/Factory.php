<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Factory
{
    /**
     * @var \Clarity\NotificationBundle\Message\Registry
     */
    private $registry;

    /**
     * @var \Clarity\NotificationBundle\Message\Resolver
     */
    private $resolver;

    /**
     * @param \Clarity\NotificationBundle\Message\Registry $registry
     * @param \Clarity\NotificationBundle\Message\Resolver $resolver
     */
    public function __construct(Registry $registry, Resolver $resolver)
    {
        $this->registry = $registry;
        $this->resolver = $resolver;
    }

    /**
     * @param mixed $type
     * @param mixed $options
     * @return \Clarity\NotificationBundle\Message\MessageInterface
     */
    public function create($type, $options = null)
    {
        $message = null;

        if ($type instanceof MessageTypeInterface) {
            $message = $this->resolver->resolve($type, $options);
        }
        
        return $message;
    }
}