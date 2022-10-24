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
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

/**
 * Class SettingsTab
 *
 * @package OxidEsales\Codeception\Admin\CoreSetting
 */
class SettingsTab extends Page
{
    /**
     * @return SettingsTab
     */
    public function openDownloadableProducts(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_SHOP_DOWNLOADABLEARTICLES'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    public function openShopFrontendDropdown(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_SHOP_FRONTEND'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    public function openStartCategoryPopup(): StartCategoryFrontendPopup
    {
        $I = $this->user;
        $I->click("//input[@value='---']");

        $I->switchToNextTab();
        $I->waitForElementVisible(['class' => 'yui-dt-data']);

        return new StartCategoryFrontendPopup($I);
    }

    public function openAdministration(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_ADMINISTRATION'));
        $I->waitForPageLoad();
        return $this;
    }

    public function setAdminFormat(string $format): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectOption('confstrs[sLocalDateFormat]', $format);
        $I->seeOptionIsSelected('confstrs[sLocalDateFormat]', $format);
        $I->waitForPageLoad();
        return $this;
    }

    public function save(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('save');
        $I->waitForPageLoad();
        return $this;
    }
}
