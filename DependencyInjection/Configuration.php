<?php

namespace Kayue\WordpressBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kayue_wordpress');

        $rootNode->children()
            ->scalarNode('site_url')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('logged_in_key')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('logged_in_salt')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('cookie_path')->defaultValue('/')->end()
            ->scalarNode('cookie_domain')->defaultValue(null)->end()
            ->scalarNode('table_prefix')->defaultValue('wp_')->end()
            ->arrayNode('sites')
                ->prototype('array')
                    ->children()
                        ->scalarNode('blog_id')->end()
                        ->scalarNode('path')->end()
                        ->scalarNode('host')->end()
                        ->arrayNode('defaults')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('requirements')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('options')
                            ->prototype('scalar')->end()
                        ->end()
                        ->scalarNode('connection')->defaultValue('doctrine.dbal.default_connection')->end()
                        ->scalarNode('configuration')->defaultValue('doctrine.orm.default_configuration')->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}