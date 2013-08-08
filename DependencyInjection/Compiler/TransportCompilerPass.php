<?php

namespace Clarity\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Clarity\NotificationBundle\Transport\Exception;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class TransportCompilerPass implements CompilerPassInterface
{   
    /**
     * @const
     */
    const TAG = 'clarity_notification.transport';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('clarity_notification.notifier')) {
            return;
        }

        $notifierDefinition = $container->getDefinition('clarity_notification.notifier');

        $transports = array();
        foreach ($container->findTaggedServiceIds(self::TAG) as $id => $tags) {
            $alias = null;
            foreach ($tags as $tag) {
                if (isset($tag['alias'])) {
                    $alias = $tag['alias'];
                }
            }

            if (null === $alias) {
                throw new Exception\TransportDeclarationException(sprintf('Transport "%s" definition with configuration tag named "%s" must contain alias attribute', $id, self::TAG));
            }

            $transports[$alias] = new Reference($id);
        }

        $notifierDefinition->replaceArgument(0, $transports);
    }
}