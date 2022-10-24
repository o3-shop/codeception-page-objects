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

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait OrderList
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
trait OrderList
{
    public $searchForm = '#search';
    public $orderNumberInput = 'where[oxorder][oxordernr]';
    public $orderBillingLastNameInput = 'where[oxorder][oxbilllname]';

    /**
     * @param int $orderNumber
     *
     * @return MainOrderPage
     */
    public function searchByOrderNumber(int $orderNumber): MainOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->submitForm($this->searchForm, [$this->orderNumberInput => $orderNumber]);

        return new MainOrderPage($I);
    }

    /**
     * @param string $field
     * @param string $value
     *
     * @return MainOrderPage
     */
    public function find(string $field, string $value): MainOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);

        $I->selectEditFrame();

        return new MainOrderPage($I);
    }

    /**
     * @return DownloadsOrderPage
     */
    public function openDownloadsTab(): DownloadsOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_downloads'));
        $I->selectEditFrame();

        return new DownloadsOrderPage($I);
    }

    /**
     * @return AddressesOrderPage
     */
    public function openAddressesTab(): AddressesOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_address'));
        $I->selectEditFrame();

        return new AddressesOrderPage($I);
    }

    /**
     * @return ProductsOrderPage
     */
    public function openProductsTab(): ProductsOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_article'));
        $I->selectEditFrame();

        return new ProductsOrderPage($I);
    }

    /**
     * @return MainOrderPage
     */
    public function deleteOrder($columNumber = '1'): MainOrderPage
    {
        $this->executeListModifier("#del.$columNumber");

        return new MainOrderPage($this->user);
    }

    /**
     * @return MainOrderPage
     */
    public function cancelOrder($columNumber = '1'): MainOrderPage
    {
        $this->executeListModifier("#pau.$columNumber");

        return new MainOrderPage($this->user);
    }

    private function executeListModifier($modifierId): void
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click($modifierId);
        $I->acceptPopup();
        $I->waitForDocumentReadyState();
    }
}
