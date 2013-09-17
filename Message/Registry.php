<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Registry
{
    /**
     * @var \Clarity\NotificationBundle\Message\Resolver
     */
    private $resolver;

    /**
     * @var array
     */
    private $types;

    /**
     * @param \Clarity\NotificationBundle\Message\Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
        $this->types = array();
    }

    /**
     * 
     */
    public function resolveAndAddType(MessageTypeInterface $type)
    {
    }
}