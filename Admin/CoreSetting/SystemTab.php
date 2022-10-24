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

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class SystemTab
 *
 * @package OxidEsales\Codeception\Admin\CoreSetting
 */
class SystemTab extends Page
{
    public $buyableParentCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantParentBuyable')]";

    /**
     * @return SystemTab
     */
    public function openVariants(): SystemTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_VARIANTS'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @return SystemTab
     */
    public function checkParentProductAsBuyable(): SystemTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->checkOption($this->buyableParentCheckbox);
        $I->seeCheckboxIsChecked($this->buyableParentCheckbox);

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForPageLoad();

        return $this;
    }
}
