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

use OxidEsales\Codeception\Page\Home;
use OxidEsales\Codeception\Page\Info\NewsletterSubscription;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class Start
 * @package OxidEsales\Codeception\Step
 */
class Start extends Step
{
    /**
     * @param string $userEmail
     * @param string $userName
     * @param string $userLastName
     *
     * @return NewsletterSubscription
     */
    public function registerUserForNewsletter(string $userEmail, string $userName, string $userLastName)
    {
        $I = $this->user;
        $homePage = new Home($I);
        $newsletterPage = $homePage->subscribeForNewsletter($userEmail);
        $newsletterPage->enterUserData($userEmail, $userName, $userLastName)->subscribe();
        $I->see(Translator::translate('MESSAGE_THANKYOU_FOR_SUBSCRIBING_NEWSLETTERS'));
        return $newsletterPage;
    }

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return Home
     */
    public function loginOnStartPage(string $userName, string $userPassword)
    {
        $I = $this->user;
        $startPage = $I->openShop();
        // if snapshot exists - skipping login
       /* if ($I->loadSessionSnapshot('login')) {
            return $startPage;
        }*/
        $startPage = $startPage->loginUser($userName, $userPassword);
      //  $I->saveSessionSnapshot('login');
        return $startPage;
    }
}
