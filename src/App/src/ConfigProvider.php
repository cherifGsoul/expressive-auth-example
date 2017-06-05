<?php

namespace App;

use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use App\Service\Authentication\Adapter\RedBeanAdapter;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
                Action\PingAction::class => Action\PingAction::class,
                RedBeanAdapter::class => RedBeanAdapter::class,
            ],
            'factories'  => [
                Action\HomePageAction::class => Action\HomePageFactory::class,
                Action\AuthAction::class => Container\AuthActionFactory::class,
                AdapterInterface::class => Container\RedBeanAdapterFactory::class,
                AuthenticationServiceInterface::class => Container\ZendAuthenticationServiceFactory::class
            ]
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
