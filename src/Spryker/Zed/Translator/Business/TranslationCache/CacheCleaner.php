<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Business\TranslationCache;

use Spryker\Zed\Translator\TranslatorConfig;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class CacheCleaner implements CacheCleanerInterface
{
    /**
     * @var \Spryker\Zed\Translator\TranslatorConfig
     */
    protected $config;

    public function __construct(TranslatorConfig $config)
    {
        $this->config = $config;
    }

    public function cleanTranslationCache(): void
    {
        $this->clearDirectory($this->config->getTranslatorCacheDirectory());
    }

    protected function clearDirectory(string $directory): void
    {
        if (!file_exists($directory)) {
            return;
        }

        $fileSystem = new Filesystem();
        $fileSystem->remove($this->findFiles($directory));
    }

    protected function findFiles(string $directory): Finder
    {
        $finder = new Finder();
        $finder
            ->in($directory)
            ->depth(0);

        return $finder;
    }
}
