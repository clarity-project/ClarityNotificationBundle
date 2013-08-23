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
    public function getOptions();

    /**
     * @param array $options
     * @return self
     */
    public function resolveOptions(array $options);

    /**
     * @param array $options
     * @return self
     */
    public function setDefaultOptions(array $options);

    /**
     * @return mixed
     */
    public function build();
}