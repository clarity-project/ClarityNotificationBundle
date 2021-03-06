<?php

namespace Clarity\NotificationBundle\Message;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Resolver
{
    /**
     * @param \Clarity\NotificationBundle\Message\MessageTypeInterface
     * @return \Clarity\NotificationBundle\Message\MessageInterface
     */
    public function resolve(MessageTypeInterface $type, $options = array())
    {
        $resolver = new OptionsResolver();
        $type->buildConfiguration($resolver);
        $data = $resolver->resolve($options);
        $data = $type->build($data);

        return new Message($type->getName(), $data);
    }
}