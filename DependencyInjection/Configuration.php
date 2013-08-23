<?php

namespace Clarity\NotificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('clarity_notification');

        $rootNode
            ->children()
                ->arrayNode('templates')
                ->prototype('array')
                    ->children()
                        ->scalarNode('from')->defaultNull()->end()
                        ->arrayNode('to')->treatNullLike(array())
                            ->beforeNormalization()
                            ->ifString()
                                ->then(function($value) { return array($value); })
                            ->end()
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('message')->treatNullLike(array())
                            ->children()
                                ->scalarNode('content')->isRequired(true)->end()
                                ->scalarNode('type')->isRequired(true)->end()
                                ->arrayNode('arguments')->treatNullLike(array())->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
