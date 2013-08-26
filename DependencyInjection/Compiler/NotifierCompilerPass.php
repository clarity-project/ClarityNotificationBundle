<?php

namespace Clarity\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Clarity\NotificationBundle\Transport\TransportException;
use Clarity\NotificationBundle\Message\MessageException;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class NotifierCompilerPass implements CompilerPassInterface
{   
    /**
     * @const
     */
    const TRANSPORT_TAG = 'clarity_notification.transport';

    /**
     * @const
     */
    const MESSAGE_TYPE_TAG = 'clarity_notification.message_type';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('clarity_notification.notifier')) {
            return;
        }

        $notifier = $container->getDefinition('clarity_notification.notifier');

        $this->processTransports($notifier, $container);
        $this->processMessages($notifier, $container);
                
        $notifier->replaceArgument(2, $container->getParameter('clarity_notification.templates'));
    }

    /**
     * Finds tagged transports and add it to notifier
     * 
     * @param \Symfony\Component\DependencyInjection\Definition $definition
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function processTransports(Definition $definition, ContainerBuilder $container)
    {
        $transports = array();
        foreach ($container->findTaggedServiceIds(self::TRANSPORT_TAG) as $id => $tags) {
            $alias = null;
            foreach ($tags as $tag) {
                if (isset($tag['alias'])) {
                    $alias = $tag['alias'];
                }
            }

            if (null === $alias) {
                throw new TransportException\TransportDeclarationException(sprintf('Transport "%s" definition with configuration tag named "%s" must contain alias attribute', $id, self::TRANSPORT_TAG));
            }

            $transports[$alias] = new Reference($id);
        }

        $definition->replaceArgument(0, $transports);
    }

    /**
     * Finds tagged messages types and add it to notifier
     * 
     * @param \Symfony\Component\DependencyInjection\Definition $definition
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function processMessages(Definition $definition, ContainerBuilder $container)
    {
        $types = array();
        foreach ($container->findTaggedServiceIds(self::MESSAGE_TYPE_TAG) as $id => $tags) {
            $alias = null;
            $transports = null;
            foreach ($tags as $tag) {
                if (isset($tag['alias'])) {
                    $alias = $tag['alias'];
                }

                if (isset($tag['transports'])) {
                    $transports = $tag['transports'];
                }
            }

            if (null === $alias) {
                throw new MessageException\MessageDeclarationException(sprintf('Message "%s" definition with configuration tag named "%s" must contain alias attribute', $id, self::MESSAGE_TYPE_TAG));
            }

            if (null === $transports) {
                throw new MessageException\MessageDeclarationException(sprintf('Message "%s" definition with configuration tag named "%s" must contain transports attribute to know allowed transports', $id, self::MESSAGE_TYPE_TAG));
            }

            $transports = explode(',', $transports);
            foreach ($transports as $key => $name) {
                $transports[$key] = trim($name);
            }

            $type = $container->getDefinition($id);
            $type->addMethodCall('setAllowedTransports', array($transports));


            $types[$alias] = new Reference($id);

        }

        $definition->replaceArgument(1, $types);
    }
}
