<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Business\TranslationResource;

use Spryker\Zed\Translator\Business\TranslationLoader\TranslationLoaderInterface;

interface TranslationResourceFileLoaderInterface
{
    public function getDomain(): ?string;

    public function findLocaleFromFilename(string $filename): ?string;

    public function getLoader(): TranslationLoaderInterface;

    /**
     * @return array<string>
     */
    public function getFilePaths(): array;
}
