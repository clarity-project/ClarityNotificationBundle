<?php

namespace Clarity\NotificationBundle;

use Clarity\NotificationBundle\Message\Type\MessageTypeInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Notifier
{
    /**
     * Transports collection
     * 
     * @var array
     */
    private $transports;

    /**
     * Templates of default options for different types of messages
     * 
     * @var array $options 
     */
    private $templates;

    /**
     * Messages types
     * 
     * @var array 
     */
    private $types;

    /**
     * @param array $transports
     * @param array $types
     * @param array $templates
     */
    public function __construct(array $transports, array $types, array $templates)
    {
        $this->transports   = $transports;
        $this->templates    = $templates;
        $this->types        = $types;
    }

    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageTypeInterface $type
     * @return \Clarity\NotificationBundle\Message\Builder
     */
    public function createMessageBuilder(MessageTypeInterface $type)
    {
        return new Message\Builder($type, $this->templates);
    }

    /**
     * @param string $type Alias name of the message type
     * @return \Clarity\NotificationBundle\Message\Builder
     */
    public function compose($type)
    {
        if (!isset($this->types[$type])) {
            throw new Transport\Exception\NotFoundException(sprintf('Message of type "%s" was not configured. Available types are: %s.', $type, implode(', ', array_keys($this->types))));
        }
        
        return $this->createMessageBuilder($this->types[$type]);
    }
}