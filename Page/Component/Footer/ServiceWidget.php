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

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\PrivateSales\Invitation;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait ServiceWidget
{
    public $basketLink = '//ul[@class="services list-unstyled"]';

    public $privateSalesInvitationLink = '//ul[@class="services list-unstyled"]';

    /**
     * @return Basket
     */
    public function openBasket()
    {
        $I = $this->user;
        $I->click(Translator::translate('CART'), $this->basketLink);
        $I->waitForPageLoad();
        return new Basket($I);
    }

    /**
     * @return Invitation
     */
    public function openPrivateSalesInvitationPage()
    {
        $I = $this->user;
        $invitationPage = new Invitation($I);
        $I->click(Translator::translate('INVITE_YOUR_FRIENDS'), $this->privateSalesInvitationLink);
        $I->waitForText(Translator::translate('INVITE_YOUR_FRIENDS'));
        return $invitationPage;
    }
}
