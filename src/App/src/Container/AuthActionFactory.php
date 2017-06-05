<?php

namespace App\Container;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use App\Action\AuthAction;

class AuthActionFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return AuthAction
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AuthAction(
            $container->get(\Zend\Expressive\Template\TemplateRendererInterface::class),
            $container->get(\Zend\Authentication\AuthenticationServiceInterface::class),
            $container->get(\Zend\Authentication\Adapter\AdapterInterface::class)
        );
    }
}
