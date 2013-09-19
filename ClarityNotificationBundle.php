<?php

namespace Clarity\NotificationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Clarity\NotificationBundle\DependencyInjection\Compiler\MessageRegistryCompilerPass;
use Clarity\NotificationBundle\DependencyInjection\Compiler\TransportRegistryCompilerPass;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class ClarityNotificationBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MessageRegistryCompilerPass());
        $container->addCompilerPass(new TransportRegistryCompilerPass());
    }
}
