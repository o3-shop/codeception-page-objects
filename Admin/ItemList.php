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
 * Class ItemList
 *
 * General admin list with items.
 *
 * @package OxidEsales\Codeception\Admin
 */
class ItemList extends \OxidEsales\Codeception\Page\Page
{
    public $navigationInformation = '#transfer';
    protected $createNewItemButton = '//div[@class="actions"]//a[@id="btn.new"]';

    /**
     * Select the item with a specific title from the list
     * and wait till edit frame with navigation information will be updated.
     *
     * @param string $itemName
     *
     * @return self
     */
    public function selectItem(string $itemName): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForText($itemName, 10);
        $I->click($itemName);
        $I->selectEditFrame();
        $I->waitForElement($this->navigationInformation, 10);

        return $this;
    }

    /**
     * @param ItemListTab $tabPage
     *
     * @return ItemListTab
     */
    public function openItemTab(ItemListTab $tabPage): ItemListTab
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForElement($tabPage->getTabSelector(), 10);
        $I->executeJS("document.evaluate(\"{$tabPage->getTabSelector()}\", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.click()");

        $I->selectEditFrame();
        $I->waitForElement($this->navigationInformation, 10);

        return $tabPage;
    }

    /**
     * @param ItemListTab $tabPage
     *
     * @return ItemListTab
     */
    protected function openCreateNewItem(ItemListTab $tabPage): ItemListTab
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createNewItemButton);
        $I->waitForPageLoad();
        $I->waitForElement($this->navigationInformation, 10);

        return $tabPage;
    }
}
