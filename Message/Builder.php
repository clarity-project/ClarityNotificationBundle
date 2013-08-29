<?php

namespace Clarity\NotificationBundle\Message;

use Clarity\NotificationBundle\Message\MessageTypeInterface;

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
    private $templates;

    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageTypeInterface
     */
    private $message;

    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageTypeInterface $transport
     * @param array $options configurations of the default templates for messages
     */
    public function __construct(MessageTypeInterface $message, array $templates)
    {
        $this->message = $message;
        $this->templates = $templates;
    }

    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageTypeInterface $message
     * @return self
     */
    public function create(MessageTypeInterface $message)
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
        if (!isset($this->templates[$name])) {
            throw new Exception\ConfigurationNotFoundException(sprintf('Configuration for "%s" not found.', $name));
        }

        $this->message->setDefaultOptions($this->templates[$name]);

        return $this;
    }

    /**
     * @param array $options
     * @return self
     */
    public function resolve(array $options)
    {
        $this->message->resolveOptions($options);

        return $this;
    }

    /**
     * @return boolean
     */
    public function notify()
    {
        return $this->transport->notify($this->message);
    }
}