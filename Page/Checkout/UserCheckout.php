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

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Component\Header\Navigation;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\Component\UserForm;

class UserCheckout extends Page
{
    use UserForm, Navigation;

    // include url of current page
    public $URL = '/index.php?lang=1&cl=user';

    public $noRegistrationOption = '//div[@id="optionNoRegistration"]/div/button';

    public $registrationOption = '//div[@id="optionRegistration"]/div[3]/button';

    public $openShipAddressForm = '#showShipAddress';

    public $openBillingAddressFormButton = '#userChangeAddress';

    public $orderRemark = '#orderRemark';

    public $breadCrumb = '#breadcrumb';

    public $nextStepButton = '#userNextStepBottom';

    public $previousStepButton = '.prevStep';

    public $openShipAddress = '//div[@id="shippingAddress"]/div[1]/div[1]/div[%s]/div/div[1]/button[1]';

    public $deleteShipAddress = '//div[@id="shippingAddress"]/div[1]/div[1]/div[%s]/div/div[1]/button[2]';

    public $selectShipAddress = '//div[@id="shippingAddress"]/div[1]/div[1]/div[%s]/div/div[2]/label';

    public $shipAddressForm = '#shippingAddressForm';

    /**
     * Opens the checkout user form without registration.
     *
     * @return $this
     */
    public function selectOptionNoRegistration()
    {
        $I = $this->user;
        $I->see(Translator::translate('PURCHASE_WITHOUT_REGISTRATION'));
        $I->click($this->noRegistrationOption);
        return $this;
    }

    /**
     * Opens checkout user form for new user registration.
     *
     * @return $this
     */
    public function selectOptionRegisterNewAccount()
    {
        $I = $this->user;
        $I->click($this->registrationOption);
        return $this;
    }

    /**
     * Opens next page: payment checkout.
     *
     * @return PaymentCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click($this->nextStepButton);
        $I->waitForElement($this->breadCrumb);
        return new PaymentCheckout($I);
    }

    /**
     * Opens previous page: cart.
     *
     * @return Basket
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->click($this->previousStepButton);
        $I->waitForElement($this->breadCrumb);
        return new Basket($I);
    }

    /**
     * @return $this
     */
    public function clickOnRegisterUserButton()
    {
        $I = $this->user;
        $I->click($this->nextStepButton);
        $I->waitForPageLoad();
        $I->waitForElement($this->breadCrumb);
        return $this;
    }

    /**
     * @return $this
     */
    public function openShippingAddressForm()
    {
        $I = $this->user;
        $I->click($this->openShipAddressForm);
        $I->dontSeeCheckboxIsChecked($this->openShipAddressForm);
        return $this;
    }

    /**
     * @return $this
     */
    public function openUserBillingAddressForm()
    {
        $I = $this->user;
        $I->click($this->openBillingAddressFormButton);
        $I->waitForElementVisible($this->billCountryId);
        return $this;
    }

    /**
     * @param string $orderRemark
     *
     * @return $this
     */
    public function enterOrderRemark(string $orderRemark)
    {
        $I = $this->user;
        $I->fillField($this->orderRemark, $orderRemark);
        return $this;
    }
}
