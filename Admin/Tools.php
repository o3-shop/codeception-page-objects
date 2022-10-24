<?php

/**
 * This file is part of O3-Shop.
 *
 * O3-Shop is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, version 3.
 *
 * O3-Shop is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with O3-Shop.  If not, see <http://www.gnu.org/licenses/>
 *
 * @copyright  Copyright (c) 2022 OXID eSales AG (https://www.oxid-esales.com)
 * @copyright  Copyright (c) 2022 O3-Shop (https://www.o3-shop.com)
 * @license    https://www.gnu.org/licenses/gpl-3.0  GNU General Public License 3 (GPLv3)
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * @deprecated use Admin\Service\Tools
 */
class Tools extends \OxidEsales\Codeception\Page\Page
{
    public $newLanguageButton = '#btn.new';
    public $activeCheckbox = 'editval[active]';
    public $abbreviationField = 'editval[abbr]';
    public $nameField = 'editval[desc]';

    /**
     * @return Tools
     */
    public function updateDbViews(): Tools
    {
        $I = $this->user;

        $I->selectEditFrame();

        $buttonValue = Translator::translate('TOOLS_MAIN_UPDATEVIEWSNOW');
        $I->click("input[value='" . $buttonValue . "']");
        $I->wait(1);
        $I->acceptPopup();

        return $this;
    }
}
