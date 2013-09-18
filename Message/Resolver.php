<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Resolver
{
    /**
     * @param \Clarity\NotificationBundle\Message\MessageTypeInterface
     * @return \Clarity\NotificationBundle\Message\MessageInterface
     */
    public function resolve(MessageTypeInterface $type, $options = null)
    {
        return new Message();
    }
}