<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator;

use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Shared\TranslatorExtension\Dependency\Plugin\Translator\TranslatorPluginInterface;
use Spryker\Shared\TranslatorExtension\Dependency\Plugin\TranslatorPluginInterface as LegacyTranslatorPluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Communication\Plugin\Pimple;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Translator\Communication\Plugin\Translator\TranslatorPlugin;
use Spryker\Zed\Translator\Communication\Plugin\TranslatorPlugin as LegacyTranslatorPlugin;
use Spryker\Zed\Translator\Dependency\Facade\TranslatorToLocaleFacadeBridge;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @method \Spryker\Zed\Translator\TranslatorConfig getConfig()
 */
class TranslatorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @uses \Spryker\Zed\Translator\Communication\Plugin\Application\TranslatorApplicationPlugin::SERVICE_TRANSLATOR
     *
     * @var string
     */
    public const SERVICE_TRANSLATOR = 'translator';

    /**
     * @deprecated Will be removed in favor of accessing the service you need directly.
     *
     * @var string
     */
    public const APPLICATION = 'APPLICATION';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const PLUGIN_TRANSLATOR = 'PLUGIN_TRANSLATOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addApplication($container);
        $container = $this->addLocaleFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addApplication($container);

        $container = $this->addTranslator($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addTranslatorPlugin($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTranslator(Container $container): Container
    {
        $container->set(static::SERVICE_TRANSLATOR, function (ContainerInterface $container) {
            return $container->getApplicationService(static::SERVICE_TRANSLATOR);
        });

        return $container;
    }

    /**
     * @deprecated Please add the service you need directly.
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApplication(Container $container): Container
    {
        $container->set(static::APPLICATION, function () {
            return (new Pimple())->getApplication();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container->set(static::FACADE_LOCALE, function (Container $container) {
            return new TranslatorToLocaleFacadeBridge($container->getLocator()->locale()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTranslatorPlugin(Container $container): Container
    {
        $container->set(static::PLUGIN_TRANSLATOR, function () {
            if (interface_exists(TranslatorInterface::class)) {
                return $this->getTranslatorPlugin();
            }

            return $this->getLegacyTranslatorPlugin();
        });

        return $container;
    }

    /**
     * @return \Spryker\Shared\TranslatorExtension\Dependency\Plugin\Translator\TranslatorPluginInterface
     */
    protected function getTranslatorPlugin(): TranslatorPluginInterface
    {
        return new TranslatorPlugin();
    }

    /**
     * @return \Spryker\Shared\TranslatorExtension\Dependency\Plugin\TranslatorPluginInterface
     */
    protected function getLegacyTranslatorPlugin(): LegacyTranslatorPluginInterface
    {
        return new LegacyTranslatorPlugin();
    }
}
