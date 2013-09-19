<?php

namespace Clarity\NotificationBundle\Message;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Registry
{
    /**
     * @var \Clarity\NotificationBundle\Message\Resolver
     */
    private $resolver;

    /**
     * @var array
     */
    private $types;

    /**
     * @param \Clarity\NotificationBundle\Message\Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
        $this->types = array();
    }

    /**
     * @param string $name
     * @return \Clarity\NotificationBundle\Message\MessageInterface
     */
    public function get($name, $options = array())
    {
        if (!isset($this->types[$name])) {
            throw new Exception\TypeNotFoundException(sprintf('Type "%s" was not found. Maybe it haven\'t been registered properly.', $name));
        }

        return $this->resolver->resolve($this->types[$name], $options);
    }

    /**
     * @param MessageTypeInterface $type
     * @return self
     */
    public function add(MessageTypeInterface $type)
    {
        if (isset($this->types[$type->getName()])) {
            throw new Exception\TypeDefinitionException(sprintf('Type with name "%s" have been already configured. Please select another alias name', $name));
        }

        $this->types[$type->getName()] = $type;
        
        return $this;
    }
}