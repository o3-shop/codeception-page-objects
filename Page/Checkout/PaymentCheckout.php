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

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for payment checkout page
 * @package OxidEsales\Codeception\Page\Checkout
 */
class PaymentCheckout extends Page
{
    use AccountMenu;

    // include url of current page
    public $URL = 'index.php?lang=1&cl=payment';

    public $paymentMethod = '';

    //save form button
    public $nextStepButton = '#paymentNextStepBottom';

    public $previousStepButton = '.prevStep';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    /**
     * @param string $paymentMethod The id of a payment method.
     *
     * @return $this
     */
    public function selectPayment(string $paymentMethod)
    {
        $I = $this->user;
        $I->click('#payment_' . $paymentMethod);
        return $this;
    }

    /**
     * Opens next page: final order step.
     *
     * @return OrderCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click($this->nextStepButton);
        $I->waitForElement($this->breadCrumb);
        return new OrderCheckout($I);
    }

    /**
     * Opens previous page: user checkout.
     *
     * @return UserCheckout
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->click($this->previousStepButton);
        $I->waitForElement($this->breadCrumb);
        return new UserCheckout($I);
    }
}
