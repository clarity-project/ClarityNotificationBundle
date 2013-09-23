<?php

namespace Clarity\NotificationBundle\Transport;

use Clarity\NotificationBundle\Message\MessageInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
interface TransportInterface
{
    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageInterface $message
     * @return boolean
     */
    public function send(MessageInterface $message);
    
    /**
     * @param \Clarity\NotificationBundle\Message\Type\MessageInterface $message
     * @return boolean
     */
    public function isSupported(MessageInterface $message);

    /**
     * @return string
     */
    public function getName();
}