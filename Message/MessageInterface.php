<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
interface MessageInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return string
     */
    public function getName();
}