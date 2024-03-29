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

namespace OxidEsales\Codeception\Step;

use Codeception\Actor;
use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Page\Checkout\Basket as BasketPage;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;

/**
 * Class Basket
 * @package OxidEsales\Codeception\Step
 */
class Basket extends Step
{
    use MiniBasket;

    /**
     * Add product to the basket without redirection
     *
     * @param string $productId The id of the product.
     * @param int    $amount    The amount of the product.
     */
    public function addProductToBasket(string $productId, int $amount)
    {
        $I = $this->user;
        //add Product to basket
        $params['fnc'] = 'tobasket';
        $params['aid'] = $productId;
        $params['am'] = $amount;
        $params['anid'] = $productId;

        $this->openPage($I, $params);
        $I->waitForElement($this->miniBasketMenuElement);
        $I->waitForPageLoad();
    }

    /**
     * Add product to the basket and open given controller:
     * 'user' for  UserCheckout page, else opens Basket page.
     *
     * This method requires existing of name='stoken' element to present
     * in Currently loaded page.
     *
     * @deprecated please use addProductToBasketAndOpenBasket()
     * or addProductToBasketAndOpenUserCheckout()
     *
     * @param string $productId
     * @param int    $amount
     * @param string $controller
     *
     * @return BasketPage|UserCheckout
     */
    public function addProductToBasketAndOpen(string $productId, int $amount, string $controller)
    {
        if ($controller === 'user') {
            return $this->addProductToBasketAndOpenUserCheckout($productId, $amount);
        }
        return $this->addProductToBasketAndOpenBasket($productId, $amount);
    }

    /**
     * Add product to the basket and open Basket page.
     *
     * @param string $productId The id of the product.
     * @param int    $amount    The amount of the product.
     *
     * @return BasketPage
     */
    public function addProductToBasketAndOpenBasket(string $productId, int $amount): BasketPage
    {
        $I = $this->user;

        //add Product to basket
        $params['cl'] = 'basket';
        $params['fnc'] = 'tobasket';
        $params['aid'] = $productId;
        $params['am'] = $amount;
        $params['anid'] = $productId;

        $this->openPage($I, $params);
        $basketPage = new BasketPage($I);
        $breadCrumbName = Translator::translate('CART');
        $basketPage->seeOnBreadCrumb($breadCrumbName);
        return $basketPage;
    }

    /**
     * Add product to the basket and open UserCheckout page.
     *
     * @param string $productId The id of the product.
     * @param int    $amount    The amount of the product.
     *
     * @return UserCheckout
     */
    public function addProductToBasketAndOpenUserCheckout(string $productId, int $amount): UserCheckout
    {
        $I = $this->user;

        //add Product to basket
        $params['cl'] = 'user';
        $params['fnc'] = 'tobasket';
        $params['aid'] = $productId;
        $params['am'] = $amount;
        $params['anid'] = $productId;

        $this->openPage($I, $params);
        $userCheckoutPage = new UserCheckout($I);
        $breadCrumbName = Translator::translate('ADDRESS');
        $userCheckoutPage->seeOnBreadCrumb($breadCrumbName);
        return $userCheckoutPage;
    }

    /**
     * This method requires existing of name='stoken' element to present
     * in Currently loaded page.
     *
     * @param Actor $I      Actor
     * @param array $params The array with url parameters.
     */
    private function openPage(Actor $I, array $params): void
    {
        if ($I->seePageHasElement('input[name=stoken]')) {
            $params['stoken'] = $I->grabValueFrom('input[name=stoken]');
        }

        if ($I->seePageHasElement('input[name=force_sid]')) {
            $params['force_sid'] = $I->grabValueFrom('input[name=force_sid]');
        }

        $I->amOnPage('/index.php?' . http_build_query($params));
    }
}
