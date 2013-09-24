<?php

namespace Clarity\NotificationBundle;

use Clarity\NotificationBundle\Transport\Registry as TransportRegistry;
use Clarity\NotificationBundle\Message\Factory as MessageFactory;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Notifier
{
    /**
     * Transports registry
     * 
     * @var Transport\Registry
     */
    private $registry;

    /**
     * Messages Factory
     * 
     * @var Message\Factory
     */
    private $factory;

    /**
     *
     */
    public function __construct(TransportRegistry $registry, MessageFactory $factory)
    {
        $this->registry = $registry;
        $this->factory = $factory;
    }

    /**
     * @param string $name
     * @return Transport\TransportInterface
     */
    public function with($name)
    {
        return $this->registry->get($name);
    }

    /**
     * Proxying of the factory
     */
    public function create($type, $data)
    {
        return $this->factory->create($type, $data);
    }
}
