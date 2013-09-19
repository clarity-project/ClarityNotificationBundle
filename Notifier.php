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
    private $templates;

    /**
     * @param array $transports
     */
    public function __construct(array $transports)
    {
        $this->transports = $transports;
    }
}
