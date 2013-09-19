<?php

namespace Clarity\NotificationBundle\Transport;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Registry
{
    /**
     * @var array
     */
    private $transports;

    /**
     * 
     */
    public function __construct()
    {
        $this->transports = array();
    }

    /**
     * @param \Clarity\NotificationBundle\Transport\TransportInterface
     * @return self
     * @throws \Clarity\NotificationBundle\Transport\Exception\TransportDefinitionException
     */
    public function add(TransportInterface $transport)
    {
        if (isset($this->transports[$transport->getName()])) {
            throw new Exception\TransportDefinitionException(sprintf('Transport with name "%s" already exist. Please choose another name.', $transport->getName()));
        }
        $this->transports[$transport->getName()] = $transport;

        return $this;
    }

    /**
     * @param string
     * @return \Clarity\NotificationBundle\Transport\TransportInterface
     * @throws \Clarity\NotificationBundle\Transport\Exception\TransportNotFoundException
     */
    public function get($name)
    {
        if (!isset($this->transports[$name])) {
            throw new Exception\TransportNotFoundException(sprintf('Transport with name "%s" was not found.', $name));
        }

        return $this->transports[$name];
    }
}