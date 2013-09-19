<?php

namespace Clarity\NotificationBundle\Message;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
interface MessageTypeInterface
{
    /**
     * @param OptionsResolverInterface
     */
    public function buildConfiguration(OptionsResolverInterface $resolver);

    /**
     * @param array $configuration
     * @return mixed
     */
    public function build(array $configuration);

    /**
     * Unique name of the message
     * 
     * @return string
     */
    public function getName();
}