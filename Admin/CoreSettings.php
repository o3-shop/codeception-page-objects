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

use OxidEsales\Codeception\Admin\CoreSetting\PerformanceTab;
use OxidEsales\Codeception\Admin\CoreSetting\SettingsTab;
use OxidEsales\Codeception\Admin\CoreSetting\SystemTab;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class CoreSettings extends Page
{
    public $newShopButton = '#btn.new';
    public $newShopNameField = '#shopname';
    public $shopParentSelect = '#shopparent';
    public $activeShopSelect = 'editval[oxshops__oxactive]';
    public $masterShopInSelectOption = '#shopparent option:nth-child(2)';
    public $inheritParentProductsOption = 'editval[oxshops__oxisinherited]';
    public $shopName = 'editval[oxshops__oxname]';
    public $tabPerformance = 'tbclshop_performance';

    /**
     * @param string $shopName
     *
     * @return CoreSettings
     */
    public function createNewShop(string $shopName): CoreSettings
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->newShopButton);
        $I->wait(3);

        //create new shop
        $I->fillField($this->newShopNameField, $shopName);
        $I->checkOption($this->inheritParentProductsOption);
        $option = $I->grabTextFrom($this->masterShopInSelectOption);
        $I->selectOption($this->shopParentSelect, $option);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->wait(5);
        $I->checkOption($this->activeShopSelect);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectListFrame();
        $I->waitForText($shopName, 10);

        return $this;
    }

    /**
     * @param string $subShopName
     *
     * @return CoreSettings
     */
    public function selectShopInList(string $subShopName): CoreSettings
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->waitForText($subShopName);
        $I->click($subShopName);
        $I->selectEditFrame();
        $I->waitForPageLoad();
        $I->seeInField($this->shopName, $subShopName);

        return $this;
    }

    /**
     * @return SystemTab
     */
    public function openSystemTab(): SystemTab
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclshop_system'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new SystemTab($I);
    }

    /**
     * @return SettingsTab
     */
    public function openSettingsTab(): SettingsTab
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclshop_config'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new SettingsTab($I);
    }

    /**
     * @return PerformanceTab
     */
    public function openPerformanceTab(): PerformanceTab
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate($this->tabPerformance));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new PerformanceTab($I);
    }
}
