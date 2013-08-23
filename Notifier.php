<?php

namespace Clarity\NotificationBundle;

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
    private $options;

    /**
     * @param array $transports
     */
    public function __construct(array $transports, array $options)
    {
        $this->transports = $transports;
        $this->options = $options;
    }

    /**
     * @param string $transport
     * @return \Clarity\NotificationBundle\Message\Builder
     */
    public function createMessageBuilder($transport)
    {
        return new Message\Builder($this->transports[$transport], $this->options);
    }

    /**
     * @param string $name Alias name of the notification transport
     * @return \Clarity\NotificationBundle\Message\Builder
     */
    public function compose($name)
    {
        if (!isset($this->transports[$name])) {
            throw new Transport\Exception\NotFoundException(sprintf('Transport with name "%s" was not found in configured list.', $name));
        }
        
        $builder = $this->createMessageBuilder($name);

        // some actions of composing message

        return $builder;
    }
}