<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Translator\TranslationResource;

use Spryker\Service\Translator\TranslationLoader\TranslationLoaderInterface;

interface TranslationResourceFileLoaderInterface
{
    /**
     * @return string|null
     */
    public function getDomain(): ?string;

    /**
     * @param string $filename
     *
     * @return string|null
     */
    public function getLocaleFromFilename(string $filename): ?string;

    /**
     * @return \Spryker\Service\Translator\TranslationLoader\TranslationLoaderInterface
     */
    public function getLoader(): TranslationLoaderInterface;

    /**
     * @return string[]
     */
    public function getFilePaths(): array;
}
