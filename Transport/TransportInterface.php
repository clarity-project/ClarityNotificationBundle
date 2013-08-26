<?php

namespace Clarity\NotificationBundle\Transport;

use Clarity\NotificationBundle\Message\Type\MessageTypeInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
interface TransportInterface
{
    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageTypeInterface $message
     * @return boolean
     */
    public function notify(MessageTypeInterface $message);
    
    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageTypeInterface $message
     * @return boolean
     */
    public function isSupported(MessageTypeInterface $message);
}