<?php

namespace Clarity\NotificationBundle;

use Clarity\NotificationBundle\Transport\Registry as TransportRegistry;

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
     * @param array $transports
     */
    public function __construct(TransportRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param string $name
     * @return Transport\TransportInterface
     */
    public function with($name)
    {
        return $this->registry->get($name);
    }
}
