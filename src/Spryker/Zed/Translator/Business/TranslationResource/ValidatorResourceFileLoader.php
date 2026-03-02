<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Business\TranslationResource;

use Spryker\Zed\Translator\Business\TranslationFinder\TranslationFileFinderInterface;
use Spryker\Zed\Translator\Business\TranslationLoader\TranslationLoaderInterface;
use Spryker\Zed\Translator\TranslatorConfig;

class ValidatorResourceFileLoader implements TranslationResourceFileLoaderInterface
{
    /**
     * @var string
     */
    protected const TRANSLATION_DOMAIN = 'validators';

    /**
     * @var \Spryker\Zed\Translator\Business\TranslationLoader\TranslationLoaderInterface
     */
    protected $translationLoader;

    /**
     * @var \Spryker\Zed\Translator\Business\TranslationFinder\TranslationFileFinderInterface
     */
    protected $translationFileFinder;

    /**
     * @var \Spryker\Zed\Translator\TranslatorConfig
     */
    protected $translatorConfig;

    /**
     * @var array
     */
    protected $locales;

    public function __construct(
        TranslationLoaderInterface $translationLoader,
        TranslationFileFinderInterface $translationFileFinder,
        TranslatorConfig $translatorConfig,
        array $locales
    ) {
        $this->translationLoader = $translationLoader;
        $this->translationFileFinder = $translationFileFinder;
        $this->translatorConfig = $translatorConfig;
        $this->locales = $locales;
    }

    public function getDomain(): ?string
    {
        return static::TRANSLATION_DOMAIN;
    }

    public function findLocaleFromFilename(string $filename): ?string
    {
        $pathInfo = pathinfo($filename);
        $filenameParts = explode('.', $pathInfo['filename']);

        return $this->locales[$filenameParts[1]] ?? null;
    }

    public function getLoader(): TranslationLoaderInterface
    {
        return $this->translationLoader;
    }

    /**
     * @return array<string>
     */
    public function getFilePaths(): array
    {
        return $this->translationFileFinder->findFilesByGlobPatterns($this->translatorConfig->getValidatorTranslationFilePatterns());
    }
}
