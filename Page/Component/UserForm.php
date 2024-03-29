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

namespace OxidEsales\Codeception\Page\Component;

trait UserForm
{
    // include form fields of current page
    public $userLoginNameField = ['id' => 'userLoginName'];
    public $userNameField = 'invadr[oxuser__oxusername]';
    public $userPasswordField = ['id' => 'userPassword'];
    public $userPasswordConfirmField = ['id' => 'userPasswordConfirm'];

    //user data
    public $userUstIDField = 'invadr[oxuser__oxustid]';
    public $userMobFonField = 'invadr[oxuser__oxmobfon]';
    public $userPrivateFonField = 'invadr[oxuser__oxprivfon]';
    public $userBirthDateDayField = 'invadr[oxuser__oxbirthdate][day]';
    public $userBirthDateMonthField = "//div[@class='btn-group bootstrap-select oxMonth form-control']/button";
    public $userBirthDateYearField = 'invadr[oxuser__oxbirthdate][year]';

    //user address data
    public $billUserSalutation = '//button[@data-id="invadr_oxuser__oxfname"]';
    public $billUserFirstName = 'invadr[oxuser__oxfname]';
    public $billUserLastName = 'invadr[oxuser__oxlname]';
    public $billCompanyName = 'invadr[oxuser__oxcompany]';
    public $billStreetNr = 'invadr[oxuser__oxstreetnr]';
    public $billStreet = 'invadr[oxuser__oxstreet]';
    public $billZIP = 'invadr[oxuser__oxzip]';
    public $billCity = 'invadr[oxuser__oxcity]';
    public $billAdditionalInfo = 'invadr[oxuser__oxaddinfo]';
    public $billFonNr = 'invadr[oxuser__oxfon]';
    public $billFaxNr = 'invadr[oxuser__oxfax]';
    public $billCountryId = "//button[@data-id='invCountrySelect']";
    public $billStateId = "//button[@data-id='oxStateSelect_invadr[oxuser__oxstateid]']";

    //user delivery address data
    public $delUserSalutation = '//button[@data-id="deladr_oxaddress__oxsal"]';
    public $delUserFirstName = 'deladr[oxaddress__oxfname]';
    public $delUserLastName = 'deladr[oxaddress__oxlname]';
    public $delCompanyName = 'deladr[oxaddress__oxcompany]';
    public $delStreetNr = 'deladr[oxaddress__oxstreetnr]';
    public $delStreet = 'deladr[oxaddress__oxstreet]';
    public $delZIP = 'deladr[oxaddress__oxzip]';
    public $delCity = 'deladr[oxaddress__oxcity]';
    public $delAdditionalInfo = 'deladr[oxaddress__oxaddinfo]';
    public $delFonNr = 'deladr[oxaddress__oxfon]';
    public $delFaxNr = 'deladr[oxaddress__oxfax]';
    public $delCountryId = "//button[@data-id='delCountrySelect']";
    public $delStateId = "//button[@data-id='oxStateSelect_deladr[oxaddress__oxstateid]']";

    public $dropdownMenu = '[role=menu]';
    public $nextOpenedDropdownMenu = '//following::div[contains(@class, "dropdown-menu") and contains(@class, "open")]';

    /**
     * @param string $userLoginName
     *
     * @return $this
     */
    public function enterUserLoginName(string $userLoginName)
    {
        $I = $this->user;
        $I->fillField($this->userLoginNameField, $userLoginName);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function modifyUserName(string $name): self
    {
        $this->user->fillField($this->userNameField, $name);
        return $this;
    }

    /**
     * Fill fields with user login data.
     * $userData = [
     * 'userLoginNameField',
     * 'userPasswordField'
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterUserLoginData(array $userData)
    {
        $I = $this->user;
        $I->fillField($this->userLoginNameField, $userData['userLoginNameField']);
        $I->fillField($this->userPasswordField, $userData['userPasswordField']);
        $I->fillField($this->userPasswordConfirmField, $userData['userPasswordField']);
        return $this;
    }

    /**
     * Fill fields with user information data.
     * $userData = [
     * 'userUstIDField',
     * 'userMobFonField',
     * 'userPrivateFonField',
     * 'userBirthDateDayField',
     * 'userBirthDateYearField',
     * 'userBirthDateMonthField'
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterUserData(array $userData)
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->fillField($this->userUstIDField, $userData['userUstIDField']);
        $I->fillField($this->userMobFonField, $userData['userMobFonField']);
        $I->fillField($this->userPrivateFonField, $userData['userPrivateFonField']);

        $I->fillField($this->userBirthDateDayField, $userData['userBirthDateDayField']);
        $I->fillField($this->userBirthDateYearField, $userData['userBirthDateYearField']);

        $I->click($this->userBirthDateMonthField);
        $I->click($this->getBirthDateMonthItem($userData['userBirthDateMonthField']));
        return $this;
    }

    /**
     * Fill fields with user billing address data.
     * $userData = [
     *  "userSalutation",
     *  "userFirstName",
     *  "userLastName",
     *  "companyName",
     *  "street",
     *  "streetNr",
     *  "ZIP",
     *  "city",
     *  "additionalInfo",
     *  "fonNr",
     *  "faxNr",
     *  "countryId",
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterAddressData(array $userData)
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $this->selectBillingAddressSalutation($userData['userSalutation']);
        $this->selectBillingCountry($userData['countryId']);
        if (isset($userData['stateId'])) {
            $this->selectBillingAddressState($userData['stateId']);
        }

        foreach ($this->removeSelectFieldsFromUserData($userData) as $textField => $value) {
            $locatorName = 'bill' . ucwords($textField);
            $I->fillField($this->{$locatorName}, $value);
        }
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectBillingCountry(string $country)
    {
        $I = $this->user;
        $this->openDropdown($this->billCountryId);
        $I->click($country);
        $this->waitForDropdownNotVisible($this->billCountryId);
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectShippingCountry(string $country)
    {
        $I = $this->user;
        $this->openDropdown($this->delCountryId);
        $I->click($country, '#shippingAddress');
        $this->waitForDropdownNotVisible($this->delCountryId);
        return $this;
    }

    /**
     * Fill fields with user shipping address data.
     * $userData = [
     *  "userSalutation",
     *  "userFirstName",
     *  "userLastName",
     *  "companyName",
     *  "street",
     *  "streetNr",
     *  "ZIP",
     *  "city",
     *  "additionalInfo",
     *  "fonNr",
     *  "faxNr",
     *  "countryId",
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterShippingAddressData(array $userData)
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $this->selectShippingAddressSalutation($userData['userSalutation']);
        $this->selectShippingCountry($userData['countryId']);
        if (isset($userData['stateId'])) {
            $this->selectShippingAddressState($userData['stateId']);
        }

        foreach ($this->removeSelectFieldsFromUserData($userData) as $textField => $value) {
            $locatorName = 'del' . ucwords($textField);
            $I->fillField($this->{$locatorName}, $value);
        }
        return $this;
    }

    private function openDropdown(string $dropdownButton): void
    {
        $I = $this->user;
        $I->waitForElement($dropdownButton);
        $I->scrollTo($dropdownButton);
        $I->waitForElementClickable($dropdownButton);
        $I->click($dropdownButton);
        $I->waitForElementClickable(
            $this->getActiveDropdown($dropdownButton)
        );
    }

    /**
     * @param int $month
     *
     * @return string
     */
    private function getBirthDateMonthItem($month): string
    {
        return "//div[@class='btn-group bootstrap-select oxMonth form-control dropup open']/div/ul/li["
            . ($month + 1)
            . ']/a';
    }

    private function selectBillingAddressSalutation($userSalutation): void
    {
        $I = $this->user;
        $this->openDropdown($this->billUserSalutation);
        $I->click($userSalutation);
        $this->waitForDropdownNotVisible($this->billUserSalutation);
    }

    private function selectBillingAddressState($stateId): void
    {
        $I = $this->user;
        $this->openDropdown($this->billStateId);
        $I->click($stateId);
        $this->waitForDropdownNotVisible($this->billStateId);
    }

    private function removeSelectFieldsFromUserData(array $userData): array
    {
        unset($userData['userSalutation'], $userData['countryId'], $userData['stateId']);
        return $userData;
    }

    private function selectShippingAddressSalutation($userSalutation): void
    {
        $I = $this->user;
        $this->openDropdown($this->delUserSalutation);
        $I->click($userSalutation, '#shippingAddress');
        $this->waitForDropdownNotVisible($this->delUserSalutation);

    }

    private function selectShippingAddressState($stateId): void
    {
        $I = $this->user;
        $this->openDropdown($this->delStateId);
        $I->click($stateId, '#shippingAddress');
        $this->waitForDropdownNotVisible($this->delStateId);
    }

    private function waitForDropdownNotVisible(string $dropdownButton): void
    {
        $I = $this->user;
        $I->waitForElementNotVisible(
            $this->getActiveDropdown($dropdownButton)
        );
    }

    private function getActiveDropdown(string $dropdownButton): string
    {
        return $dropdownButton . $this->nextOpenedDropdownMenu;
    }
}
