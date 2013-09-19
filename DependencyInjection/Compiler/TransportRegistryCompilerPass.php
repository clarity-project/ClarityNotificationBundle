<?php

namespace Clarity\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class TransportRegistryCompilerPass implements CompilerPassInterface
{   
    /**
     * @const
     */
    const TRANSPORT_TAG = 'clarity_notification.transport';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('clarity_notification.transport_registry')) {
            return;
        }

        $registryDefinition = $container->getDefinition('clarity_notification.transport_registry');

        foreach ($container->findTaggedServiceIds(self::TRANSPORT_TAG) as $id => $tags) {
            $registryDefinition->addMethodCall('add', array(new Reference($id)));
        }
    }
}