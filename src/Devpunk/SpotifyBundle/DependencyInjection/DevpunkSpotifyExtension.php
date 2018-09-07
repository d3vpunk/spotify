<?php

namespace Devpunk\SpotifyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DevpunkSpotifyExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $authentication = $config['authentication'];
        $container->setParameter('devpunk.spotify.client_id', $authentication['client_id']);
        $container->setParameter('devpunk.spotify.client_secret', $authentication['client_secret']);
        $container->setParameter('devpunk.spotify.client_redirect_uri', $authentication['redirect_uri']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
