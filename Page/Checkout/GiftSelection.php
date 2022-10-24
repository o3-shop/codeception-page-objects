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

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for gift options page
 *
 * @package OxidEsales\Codeception\Page\Checkout
 */
class GiftSelection extends Page
{
    public $selectWrapping = '//div[@id="wrapp_%s"]//input[@id="wrapping_%s"]';

    public $selectGiftCard = '//div[@id="wrappCard"]//input[@id="chosen_%s"]';

    public $greetingsTextField = '#giftmessage';

    public $submitChangesButton = '';

    /**
     * Select a wrapping with given id.
     *
     * @param int    $itemPosition The position of basket item.
     * @param string $wrappingId   The id of wrapping.
     *
     * @return $this
     */
    public function selectWrapping(int $itemPosition, string $wrappingId)
    {
        $I = $this->user;
        $I->click(sprintf($this->selectWrapping, $itemPosition, $wrappingId));
        return $this;
    }

    /**
     * Select a gift card with given id.
     *
     * @param string $cardId The gift card id
     *
     * @return $this
     */
    public function selectCard(string $cardId)
    {
        $I = $this->user;
        $I->click(sprintf($this->selectGiftCard, $cardId));
        return $this;
    }

    /**
     * Add a greeting message.
     *
     * @param string $message
     *
     * @return $this
     */
    public function addGreetingMessage(string $message)
    {
        $I = $this->user;
        $I->fillField($this->greetingsTextField, $message);
        return $this;
    }

    /**
     * Submit changes made in this page and continue with checkout.
     *
     * @return Basket
     */
    public function submitChanges() : Basket
    {
        $I = $this->user;
        $basketPage = new Basket($I);
        $I->click(Translator::translate('APPLY'));
        $I->waitForElement($basketPage->breadCrumb);
        return $basketPage;
    }
}
