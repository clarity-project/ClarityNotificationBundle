<?php

namespace Clarity\NotificationBundle;

use Clarity\NotificationBundle\Type\MessageTypeInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MessageFactory
{
    /**
     * @var MessageRegistry
     */
    private $registry;

    /**
     * @param MessageRegistry $registry
     */
    public function __construct(MessageRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param mixed
     * @return Message
     */
    public function create($type = 'message')
    {
        return $this->createBuilder($type)->getForm();
    }

    public function createBuilder($type)
    {
        if (!$type instanceof MessageTypeInterface && is_string($type)) {
            $type = $this->registry->get($type);
        }

        
    }
}