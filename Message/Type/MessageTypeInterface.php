<?php

namespace Clarity\NotificationBundle\Message\Type;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
interface MessageTypeInterface
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
     * @param array $transports
     * @return self
     */
    public function setAllowedTransports(array $transports);

    /**
     * @return mixed
     */
    public function build();
}