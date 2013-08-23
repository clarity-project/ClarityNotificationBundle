<?php

namespace Clarity\NotificationBundle\Message;

use Clarity\NotificationBundle\Transport\TransportInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Builder
{
    /**
     * @var \Clarity\NotificationBundle\Transport\TransportInterface
     */
    private $transport;

    /**
     * @var array
     */
    private $options;

    /**
     * @param \Clarity\NotificationBundle\Message\MessageInterface
     */
    private $message;

    /**
     * @param \Clarity\NotificationBundle\Transport\TransportInterface $transport
     * @param array $options configurations of the default templates for messages
     */
    public function __construct(TransportInterface $transport, array $options)
    {
        $this->transport = $transport;
        $this->options = $options;
    }

    /**
     * @param \Clarity\NotificationBundle\Message\MessageInterface $message
     * @return self
     */
    public function create(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $name
     * @return self
     */
    public function with($name)
    {
        if (!isset($this->options[$name])) {
            throw new Exception\ConfigurationNotFoundException(sprintf('Configuration for "%s" not found.', $name));
        }

        $this->message->setDefaultOptions($this->options[$name]);

        return $this;
    }
}