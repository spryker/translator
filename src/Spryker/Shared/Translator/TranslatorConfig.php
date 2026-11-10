<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Translator;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class TranslatorConfig extends AbstractSharedConfig
{
    /**
     * @api
     *
     * @return array<string>
     */
    public function getProjectNamespaces(): array
    {
        return $this->get(TranslatorConstants::PROJECT_NAMESPACES);
    }
}
