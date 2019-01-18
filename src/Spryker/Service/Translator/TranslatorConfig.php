<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Translator;

use Spryker\Service\Kernel\AbstractBundleConfig;
use Spryker\Shared\Translator\TranslatorConstants;

class TranslatorConfig extends AbstractBundleConfig
{
    public const CSV_DELIMITER = ',';

    /**
     * @return string[]
     */
    public function getTranslationFilePathPatterns(): array
    {
        return array_merge($this->getCoreTranslationFilePathPatterns(), $this->getProjectTranslationFilePathPatterns());
    }

    /**
     * @return string[]
     */
    public function getCoreTranslationFilePathPatterns(): array
    {
        return [
            APPLICATION_VENDOR_DIR . '/spryker/*/data/translation/Zed/[a-z][a-z]_[A-Z][A-Z].csv',
        ];
    }

    /**
     * @return string[]
     */
    public function getValidatorTranslationFilePatterns(): array
    {
        return [
            APPLICATION_VENDOR_DIR . '/symfony/validator/Resources/translations/validators.[a-z][a-z].xlf',
        ];
    }

    /**
     * @return string[]
     */
    public function getProjectTranslationFilePathPatterns(): array
    {
        return $this->get(TranslatorConstants::TRANSLATION_FILE_PATH_PATTERNS, []);
    }

    /**
     * @param string $localeCode
     *
     * @return string[]
     */
    public function getFallbackLocales(string $localeCode): array
    {
        $fallbackLocales = $this->get(TranslatorConstants::TRANSLATION_FALLBACK_LOCALES, []);

        return $fallbackLocales[$localeCode] ?? [];
    }

    /**
     * @return string
     */
    public function getCacheDir(): string
    {
        return $this->get(TranslatorConstants::TRANSLATION_CACHE_DIRECTORY);
    }

    /**
     * @return string
     */
    public function getCsvDelimiter(): string
    {
        return static::CSV_DELIMITER;
    }
}
