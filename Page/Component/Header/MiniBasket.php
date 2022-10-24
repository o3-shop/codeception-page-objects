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

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait for mini basket widget.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait MiniBasket
{
    public $miniBasketMenuElement = '//div[@class="btn-group minibasket-menu"]/button';

    public $miniBasketTitle = '//div[@class="minibasket-menu-box"]/p';

    public $miniBasketItemTitle = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[2]/a';

    public $miniBasketItemAmount = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[1]/span';

    public $miniBasketItemPrice = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[3]';

    public $miniBasketSummaryPrice = '//td[@class="total_price text-right"]';

    /**
     * Assert basket product
     *
     * $basketProducts[] = ['title' => productTitle,
     *                   'price' => productPrice,
     *                   'amount' => productAmount,]
     *
     * @param array  $basketProducts
     * @param string $basketSummaryPrice
     * @param string $totalAmount
     *
     * @return $this
     */
    public function seeMiniBasketContains(array $basketProducts, string $basketSummaryPrice, string $totalAmount)
    {
        $I = $this->user;
        $this->openMiniBasket();
        $I->see( $totalAmount . ' ' . Translator::translate('ITEMS_IN_BASKET'));
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = $key + 1;
            $I->see($basketProduct['title'], $I->clearString(sprintf($this->miniBasketItemTitle, $itemPosition)));
            $I->see($basketProduct['amount'], sprintf($this->miniBasketItemAmount, $itemPosition));
            $I->see($basketProduct['price'], sprintf($this->miniBasketItemPrice, $itemPosition));
        }
        $I->see($basketSummaryPrice, $this->miniBasketSummaryPrice);
        return $this;
    }

    /**
     * Opens mini basket box.
     *
     * @return $this
     */
    public function openMiniBasket()
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->waitForElementClickable($this->miniBasketMenuElement);
        $I->click($this->miniBasketMenuElement);
        $I->waitForText(Translator::translate('DISPLAY_BASKET'));
        return $this;
    }

    /**
     * Open checkout page.
     * If user is logged in, open PaymentCheckout page.
     * If user is not logged in, open UserCheckout page.
     *
     * @return UserCheckout|PaymentCheckout
     */
    public function openCheckout()
    {
        $I = $this->user;
        $I->click(Translator::translate('CHECKOUT'));
        $I->waitForPageLoad();
        if (Context::isUserLoggedIn()) {
            return new PaymentCheckout($I);
        } else {
            return new UserCheckout($I);
        }
    }

    /**
     * Open cart page.
     *
     * @return Basket
     */
    public function openBasketDisplay()
    {
        $I = $this->user;
        $I->click(Translator::translate('DISPLAY_BASKET'));
        $I->see(Translator::translate('CART'));
        return new Basket($I);
    }

    public function checkBasketEmpty(): void
    {
        $I = $this->user;
        $I->click($this->miniBasketMenuElement);
        $I->see(Translator::translate('BASKET_EMPTY'));
    }

    public function seeCountdownWithinBasket(): void
    {
        $I = $this->user;
        $I->click($this->miniBasketMenuElement);
        $I->seeElement('#countdown');
    }
}
