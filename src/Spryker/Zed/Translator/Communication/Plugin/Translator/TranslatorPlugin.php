<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Communication\Plugin\Translator;

use Spryker\Shared\TranslatorExtension\Dependency\Plugin\Translator\TranslatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\Translator\Business\TranslatorFacadeInterface getFacade()
 * @method \Spryker\Zed\Translator\Communication\TranslatorCommunicationFactory getFactory()
 * @method \Spryker\Zed\Translator\TranslatorConfig getConfig()
 */
class TranslatorPlugin extends AbstractPlugin implements TranslatorPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $id
     * @param array $parameters
     * @param string|null $domain
     * @param string|null $locale
     *
     * @return string
     */
    public function trans(string $id, array $parameters = [], ?string $domain = null, ?string $locale = null): string
    {
        return $this->getFacade()->trans($id, $parameters, $domain, $locale);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $id
     * @param int $number
     * @param array $parameters
     * @param string|null $domain
     * @param string|null $locale
     *
     * @return string
     */
    public function transChoice(string $id, int $number, array $parameters = [], $domain = null, $locale = null): string
    {
        $parameters['%count%'] = $number;

        return $this->getFacade()->trans($id, $parameters, $domain, $locale);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed without replacement.
     *
     * @see \Symfony\Contracts\Translation\TranslatorInterface
     *
     * @param string $locale
     *
     * @return void
     */
    public function setLocale($locale): void
    {
        $this->getFacade()->setLocale($locale);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed without replacement.
     *
     * @see \Symfony\Contracts\Translation\TranslatorInterface
     *
     * @return string The locale
     */
    public function getLocale(): string
    {
        return $this->getFacade()->getLocale();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $keyName
     * @param string $locale
     *
     * @return bool
     */
    public function has(string $keyName, string $locale): bool
    {
        return $this->getFacade()->has($keyName, $locale);
    }
}
