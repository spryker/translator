<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\Translator\Business\TranslatorBusinessFactory getFactory()
 */
class TranslatorFacade extends AbstractFacade implements TranslatorFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return void
     */
    public function generateTranslationCache(): void
    {
        $this->getFactory()->getTranslatorService()->generateTranslationCache();
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return void
     */
    public function cleanTranslationCache(): void
    {
        $this->getFactory()->getTranslatorService()->cleanTranslationCache();
    }

    /**
     * @api
     *
     * @param string $keyName
     *
     * @return bool
     */
    public function hasTranslation($keyName): bool
    {
        return $this->getFactory()->getTranslatorService()->hasTranslation($keyName);
    }

    /**
     * @api
     *
     * @param string $keyName
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $localeTransfer
     *
     * @return string
     */
    public function translate($keyName, array $data = [], ?LocaleTransfer $localeTransfer = null): string
    {
         return $this->getFactory()->getTranslatorService()->translate($keyName, $data, $localeTransfer);
    }
}
