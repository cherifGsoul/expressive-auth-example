<?php

namespace App\Container;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use App\Service\Authentication\Adapter\RedBeanAdapter;

class RedBeanAdapterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return RedBeanAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new RedBeanAdapter();
    }
}
