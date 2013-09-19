<?php

namespace Clarity\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Clarity\NotificationBundle\Transport\Exception as Exception;

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
            // get alias of the transport
            $alias = null;
            foreach ($tags as $tag) {
                if (isset($tag['alias'])) {
                    $alias = $tag['alias'];
                }
            }
            if (null === $alias) {
                throw new Exception\TransportDefinitionException(sprintf('Transport "%s" definition with configuration tag named "%s" must contain alias attribute', $id, self::TRANSPORT_TAG));
            }

            // set supported message types to each transport
            $transport = $container->getDefinition($id);
            $supported = array();
            $parameterName = sprintf('clarity_notification.transport.%s.supported_messages', $alias);
            if ($container->hasParameter($parameterName)) {
                $supported = $container->getParameter($parameterName);
            }

            $transport->addMethodCall('setSupported', array($supported));
            // add transport to registry
            $registryDefinition->addMethodCall('add', array(new Reference($id)));
        }
    }
}