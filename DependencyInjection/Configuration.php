<?php

namespace MB\SecureDisplayBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mb_secure_display');

        $rootNode
            ->children()
                ->scalarNode('key')->end()
                ->scalarNode('template')
                    ->defaultValue('MBSecureDisplayBundle::secure_display.html.twig')
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
