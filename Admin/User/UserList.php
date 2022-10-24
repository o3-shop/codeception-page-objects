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

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Module\Translation\Translator;

trait UserList
{
    use FrameLoader;

    public $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public $searchForm = '#search';
    public $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';
    public $usernameSearchField = "where[oxuser][oxusername]";
    public $newUserButton  = '#btn.new';
    public $newRemarkButton = '#btn.newremark';
    public $newAddressButton = '#btn.newaddress';

    /**
     * @param string $field
     * @param string $value
     * @return MainUserPage
     */
    public function find(string $field, string $value): MainUserPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame(); // Waits for list section to load

        $I->click($this->firstRowName);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainUserPage($I);
    }

    /**
     * @param string $value
     * @return MainUserPage
     */
    public function findByUserName(string $value): MainUserPage
    {
        return $this->find($this->usernameSearchField, $value);
    }

    /**
     * @param AdminUser $adminUser
     *
     * @return MainUserPage
     */
    public function createNewUser(AdminUser $adminUser, AdminUserAddresses $adminUserAddress): MainUserPage
    {
        $I = $this->user;
        $mainUserPage = new MainUserPage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newUserButton, $mainUserPage->userFirstNameField);
        $mainUserPage->editUser($adminUser, $adminUserAddress);

        return $mainUserPage;
    }

    /**
     * @return ExtendedInformationPage
     */
    public function openExtendedTab(): ExtendedInformationPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_extend'));

        $I->selectEditFrame();

        return new ExtendedInformationPage($I);
    }

    /**
     * @return UserHistoryPage
     */
    public function openHistoryTab(): UserHistoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_remark'));

        $I->selectEditFrame();

        return new UserHistoryPage($I);
    }

    /**
     * @return UserProductsPage
     */
    public function openProductsTab(): UserProductsPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_article'));

        $I->selectEditFrame();

        return new UserProductsPage($I);
    }

    /**
     * @return UserPaymentInformationPage
     */
    public function openPaymentTab(): UserPaymentInformationPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_payment'));

        $I->selectEditFrame();

        return new UserPaymentInformationPage($I);
    }

    /**
     * @return UserAddressPage
     */
    public function openAddressesTab(): UserAddressPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_address'));

        $I->selectEditFrame();

        return new UserAddressPage($I);
    }

    /**
     * @param string $text
     * @return UserHistoryPage
     */
    public function createNewRemark(string $text): UserHistoryPage
    {
        $I = $this->user;

        $I->click($this->newRemarkButton);

        $I->selectEditFrame();

        $I->waitForPageLoad();

        $historyPage = new UserHistoryPage($I);
        $I->fillField($historyPage->remarkField, $text);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectEditFrame();

        return $historyPage;
    }

    /**
     * @param AdminUserAddresses $adminUserAddresses
     * @return UserAddressPage
     */
    public function createNewAddress(AdminUserAddresses $adminUserAddresses): UserAddressPage
    {
        $I = $this->user;
        $addressPage = new UserAddressPage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newAddressButton, $addressPage->addressFirstNameField);
        $addressPage->editUserAddress($adminUserAddresses);

        return $addressPage;
    }
}
