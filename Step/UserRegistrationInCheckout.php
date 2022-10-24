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

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class UserRegistrationInCheckout
 * @package OxidEsales\Codeception\Step
 */
class UserRegistrationInCheckout extends Step
{
    /**
     * @param array $userLoginData
     * @param array $userData
     * @param array $addressData
     * @param array $shippingAddressData
     *
     * @return \OxidEsales\Codeception\Page\Checkout\PaymentCheckout
     */
    public function createRegisteredUserInCheckout(
        array $userLoginData,
        array $userData,
        array $addressData,
        array $shippingAddressData = [])
    {
        $userCheckout = $this->enterRegisteredUserData($userLoginData, $userData, $addressData);

        if (!empty($shippingAddressData)) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $paymentPage = $userCheckout->goToNextStep();
        $breadCrumbName = Translator::translate("PAY");
        $paymentPage->seeOnBreadCrumb($breadCrumbName);
        return $paymentPage;
    }

    /**
     * @param array $userLogin
     * @param array $userData
     * @param array $addressData
     * @param array $shippingAddressData
     *
     * @return \OxidEsales\Codeception\Page\Checkout\PaymentCheckout
     */
    public function createNotRegisteredUserInCheckout(
        string $userLogin,
        array $userData,
        array $addressData,
        array $shippingAddressData = [])
    {
        $userCheckout = $this->enterNotRegisteredUserData($userLogin, $userData, $addressData);

        if (!empty($shippingAddressData)) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $paymentPage = $userCheckout->goToNextStep();
        $breadCrumbName = Translator::translate("PAY");
        $paymentPage->seeOnBreadCrumb($breadCrumbName);
        return $paymentPage;
    }

    /**
     * @param array $userLoginData
     * @param array $userData
     * @param array $addressData
     * @param array $shippingAddressData
     *
     * @return \OxidEsales\Codeception\Page\Checkout\UserCheckout
     */
    public function createNotValidRegisteredUserInCheckout(
        array $userLoginData,
        array $userData,
        array $addressData,
        array $shippingAddressData = [])
    {
        $I = $this->user;
        $userCheckout = $this->enterRegisteredUserData($userLoginData, $userData, $addressData);

        if (!empty($shippingAddressData)) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $userCheckout = $userCheckout->clickOnRegisterUserButton();
        $breadCrumbName = Translator::translate("ADDRESS");
        $userCheckout->seeOnBreadCrumb($breadCrumbName);
        $I->see($breadCrumbName, $userCheckout->breadCrumb);

        return $userCheckout;
    }

    /**
     * @param array $userLoginData
     * @param array $userData
     * @param array $addressData
     *
     * @return UserCheckout
     */
    private function enterRegisteredUserData(array $userLoginData, array $userData, array $addressData)
    {
        $userCheckout = new UserCheckout($this->user);
        $userCheckout = $userCheckout->selectOptionRegisterNewAccount();

        $userCheckout->enterUserLoginData($userLoginData)
            ->enterUserData($userData)
            ->enterAddressData($addressData);
        return $userCheckout;
    }

    /**
     * @param array $userLogin
     * @param array $userData
     * @param array $addressData
     *
     * @return UserCheckout
     */
    private function enterNotRegisteredUserData(string $userLogin, array $userData, array $addressData)
    {
        $userCheckout = new UserCheckout($this->user);
        $userCheckout = $userCheckout->selectOptionNoRegistration();

        $userCheckout->enterUserLoginName($userLogin)
            ->enterUserData($userData)
            ->enterAddressData($addressData);
        return $userCheckout;
    }
}
