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

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;

/**
 * @deprecated class will be removed. Use OxidEsales\Codeception\Admin\User\UserAddressPage.
 */
trait AdminUserAddressesForm
{
    Public $addressTitleField = 'editval[oxaddress__oxsal]';
    Public $addressTitleSelector = "//input[@name='editval[oxaddress__oxsal]']";
    Public $addressFirstNameField = 'editval[oxaddress__oxfname]';
    Public $addressLastNameField = 'editval[oxaddress__oxlname]';
    Public $addressCompanyField = 'editval[oxaddress__oxcompany]';
    Public $addressStreetField = 'editval[oxaddress__oxstreet]';
    Public $addressStreetNumberField = 'editval[oxaddress__oxstreetnr]';
    Public $addressZipCodeField = 'editval[oxaddress__oxzip]';
    Public $addressCityField = 'editval[oxaddress__oxcity]';
    Public $addressAdditonalInformationField = 'editval[oxaddress__oxaddinfo]';
    Public $addressCountryIdField = 'editval[oxaddress__oxcountryid]';
    Public $addressPhoneField = 'editval[oxaddress__oxfon]';
    Public $addressFaxField = 'editval[oxaddress__oxfax]';

    /**
     * @param Actor     $I
     * @param AdminUserAddresses $adminUserAddresses
     */
    public function fillUserAddressForm(Actor $I, AdminUserAddresses $adminUserAddresses): void
    {
        $fillForm = new FillForm();

        if($adminUserAddresses->getTitle() != NULL){
            $fillForm->chooseFormSelect($I, $this->addressTitleField, $adminUserAddresses->getTitle());
        }

        if($adminUserAddresses->getFirstName() != NULL){
            $fillForm->fillFormInput($I, $this->addressFirstNameField, $adminUserAddresses->getFirstName());
        }

        if($adminUserAddresses->getLastName() != NULL){
            $fillForm->fillFormInput($I, $this->addressLastNameField, $adminUserAddresses->getLastName());
        }

        if($adminUserAddresses->getCompany() != NULL){
            $fillForm->fillFormInput($I, $this->addressCompanyField, $adminUserAddresses->getCompany());
        }

        if($adminUserAddresses->getStreet() != NULL){
            $fillForm->fillFormInput($I, $this->addressStreetField, $adminUserAddresses->getStreet());
        }

        if($adminUserAddresses->getStreetNumber() != NULL){
            $fillForm->fillFormInput($I, $this->addressStreetNumberField, $adminUserAddresses->getStreetNumber());
        }

        if($adminUserAddresses->getZip() != NULL){
            $fillForm->fillFormInput($I, $this->addressZipCodeField, $adminUserAddresses->getZip());
        }

        if($adminUserAddresses->getCity() != NULL){
            $fillForm->fillFormInput($I, $this->addressCityField, $adminUserAddresses->getCity());
        }

        if($adminUserAddresses->getAdditionalInfo() != NULL){
            $fillForm->fillFormInput($I, $this->addressAdditonalInformationField, $adminUserAddresses->getAdditionalInfo());
        }

        if($adminUserAddresses->getCountryId() != NULL){
            $fillForm->chooseFormSelect($I, $this->addressCountryIdField, $adminUserAddresses->getCountryId());
        }

        if($adminUserAddresses->getPhone() != NULL){
            $fillForm->fillFormInput($I, $this->addressPhoneField, $adminUserAddresses->getPhone());
        }

        if($adminUserAddresses->getFax() != NULL){
            $fillForm->fillFormInput($I, $this->addressFaxField, $adminUserAddresses->getFax());
        }
    }
}
