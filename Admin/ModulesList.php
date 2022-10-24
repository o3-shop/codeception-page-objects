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

namespace OxidEsales\Codeception\Admin;

/**
 * Class ModulesList
 *
 * @package OxidEsales\Codeception\Admin
 */
class ModulesList extends \OxidEsales\Codeception\Page\Page
{
    public $moduleInformation = '#transfer';
    public $moduleTabSelector = '//div[@class="tabs"]//a[text()="%s"]';

    /**
     * @param string $moduleName
     *
     * @return ModulesList
     */
    public function selectModule(string $moduleName): ModulesList
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForText($moduleName, 10);
        $I->click($moduleName);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation, 10);

        return $this;
    }

    /**
     * @param string $tab
     *
     * @return ModulesList
     */
    public function openModuleTab(string $tab): ModulesList
    {
        $I = $this->user;

        $I->selectListFrame();
        $selector = sprintf($this->moduleTabSelector, $tab);
        $I->waitForElement($selector, 10);
        $I->click($selector);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation, 10);

        return $this;
    }
}
