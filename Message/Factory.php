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

    private $resolver;

    /**
     * 
     */
    public function __construct(Registry $registry, Resolver $resolver)
    {
        $this->registry = $registry;
        $this->resolver = $resolver;
    }
}