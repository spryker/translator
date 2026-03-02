<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Translator\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Spryker\Zed\Translator\Communication\TranslatorCommunicationFactory getFactory()
 * @method \Spryker\Zed\Translator\Business\TranslatorFacadeInterface getFacade()
 */
class GenerateTranslationCacheConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'translator:generate-cache';

    /**
     * @var string
     */
    public const DESCRIPTION = 'Generate new translation cache for Zed';

    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getFacade()->cleanTranslationCache();
        $this->getFacade()->generateTranslationCache();

        return static::CODE_SUCCESS;
    }
}
