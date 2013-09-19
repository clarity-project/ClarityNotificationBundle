<?php

namespace Clarity\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MessageRegistryCompilerPass implements CompilerPassInterface
{   
    /**
     * @const
     */
    const MESSAGE_TAG = 'clarity_notification.message_type';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('clarity_notification.message_registry')) {
            return;
        }

        $registryDefinition = $container->getDefinition('clarity_notification.message_registry');

        foreach ($container->findTaggedServiceIds(self::MESSAGE_TAG) as $id => $tags) {
            $registryDefinition->addMethodCall('add', array(new Reference($id)));
        }
    }
}