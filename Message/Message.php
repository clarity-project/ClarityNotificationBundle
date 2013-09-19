<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $config;

    /**
     * @param string $name
     * @param array $config
     */
    public function __construct($name, array $config)
    {
        $this->name = $name;
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }
}