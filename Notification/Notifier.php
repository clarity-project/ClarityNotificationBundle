<?php

namespace Clarity\NotificationBundle\Notification;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Notifier
{
    /**
     * Providers collection
     * 
     * @var array
     */
    private $transports;

    /**
     * @param array $transports
     */
    public function __construct(array $transports)
    {
        $this->transports = $transports;
    }

    /**
     * @param string $name Alias name of the notification transport
     * @return \Clarity\NotificationBundle\Transport\TransportInterface
     */
    public function get($name)
    {

    }
}