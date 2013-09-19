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
     * @var mixed
     */
    private $data;

    /**
     * @param string $name
     * @param mixed $data
     */
    public function __construct($name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }
}