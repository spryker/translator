<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Business\TranslationResource;

use Spryker\Zed\Translator\Business\TranslationFinder\TranslationFileFinderInterface;
use Spryker\Zed\Translator\Business\TranslationLoader\TranslationLoaderInterface;
use Spryker\Zed\Translator\TranslatorConfig;

class CsvResourceFileLoader implements TranslationResourceFileLoaderInterface
{
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

    public function __construct(
        TranslationLoaderInterface $translationLoader,
        TranslationFileFinderInterface $translationFileFinder,
        TranslatorConfig $translatorConfig
    ) {
        $this->translationLoader = $translationLoader;
        $this->translationFileFinder = $translationFileFinder;
        $this->translatorConfig = $translatorConfig;
    }

    public function getDomain(): ?string
    {
        return null;
    }

    public function findLocaleFromFilename(string $filename): ?string
    {
        $pathInfo = pathinfo($filename);

        return $pathInfo['filename'];
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
        return $this->translationFileFinder->findFilesByGlobPatterns($this->translatorConfig->getTranslationFilePathPatterns());
    }
}
