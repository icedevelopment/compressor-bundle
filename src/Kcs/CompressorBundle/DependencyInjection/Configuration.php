<?php

namespace Kcs\CompressorBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('kcs_compressor');

        $rootNode
            ->children()
            ->booleanNode('enabled')->defaultTrue()->end()
            ->booleanNode('compress_html')->defaultTrue()->end()
            ->booleanNode('preserve_line_breaks')->defaultTrue()->end()

            ->booleanNode('remove_comments')->defaultTrue()->end()
            ->booleanNode('remove_extra_spaces')->defaultTrue()->end()
            ->booleanNode('compress_js')->defaultTrue()->end()
            ->booleanNode('compress_css')->defaultTrue()->end()
            ->scalarNode('skip_block_tag')->defaultValue('\{\{\{')->end()

            ->scalarNode('js_compressor')
                ->validate()
                    ->ifNotInArray(array('none', 'yui', 'custom'))
                    ->thenInvalid('%s is not a supported js compressor')
                ->end()
                ->defaultValue('none')
            ->end()
            ->scalarNode('js_compressor_class')->defaultNull()->end()
            ->scalarNode('css_compressor')
                ->validate()
                    ->ifNotInArray(array('none', 'yui', 'custom'))
                    ->thenInvalid('%s is not a supported css compressor')
                ->end()
                ->defaultValue('none')
            ->end()
            ->scalarNode('css_compressor_class')->defaultNull()->end()

            ->scalarNode('yui_jar')->defaultNull()->end()
            ->scalarNode('java_path')->defaultNull()->end()
        ->end();

        return $treeBuilder;
    }
}
