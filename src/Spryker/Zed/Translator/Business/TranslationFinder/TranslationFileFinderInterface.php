<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Business\TranslationFinder;

interface TranslationFileFinderInterface
{
    /**
     * @param array<string> $translationFilePathPatterns
     *
     * @return array<string>
     */
    public function findFilesByGlobPatterns(array $translationFilePathPatterns): array;
}
