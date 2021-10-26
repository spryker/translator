<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Communication\Plugin\Validator;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\ValidatorExtension\Dependency\Plugin\ValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Validator\Util\LegacyTranslatorProxy;
use Symfony\Component\Validator\ValidatorBuilder;

/**
 * @method \Spryker\Zed\Translator\Business\TranslatorFacadeInterface getFacade()
 * @method \Spryker\Zed\Translator\Communication\TranslatorCommunicationFactory getFactory()
 * @method \Spryker\Zed\Translator\TranslatorConfig getConfig()
 */
class TranslatorValidatorPlugin extends AbstractPlugin implements ValidatorPluginInterface
{
    /**
     * @uses \Spryker\Zed\Translator\Communication\Plugin\Application\TranslatorApplicationPlugin::SERVICE_TRANSLATOR
     *
     * @var string
     */
    protected const SERVICE_TRANSLATOR = 'translator';

    /**
     * @var string
     */
    protected const TRANSLATION_DOMAIN = 'validators';

    /**
     * {@inheritDoc}
     * - Adds `translator`.
     *
     * @api
     *
     * @param \Symfony\Component\Validator\ValidatorBuilder $validatorBuilder
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Validator\ValidatorBuilder
     */
    public function extend(ValidatorBuilder $validatorBuilder, ContainerInterface $container): ValidatorBuilder
    {
        $validatorBuilder->setTranslator($this->getTranslator($container));
        $validatorBuilder->setTranslationDomain(static::TRANSLATION_DOMAIN);

        return $validatorBuilder;
    }

    /**
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\Validator\Util\LegacyTranslatorProxy|\Spryker\Shared\Translator\TranslatorInterface
     */
    protected function getTranslator(ContainerInterface $container)
    {
        $translator = $container->get(static::SERVICE_TRANSLATOR);

        if (class_exists(LegacyTranslatorProxy::class)) {
            $translator = new LegacyTranslatorProxy($translator);
        }

        return $translator;
    }
}
