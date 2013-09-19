<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
interface MessageInterface
{
    /**
     * @return array
     */
    public function getConfig();

    /**
     * @return string
     */
    public function getName();
}