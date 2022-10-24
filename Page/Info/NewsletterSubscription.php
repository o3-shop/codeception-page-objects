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

namespace OxidEsales\Codeception\Page\Info;

use OxidEsales\Codeception\Page\Page;

/**
 * Class for newsletter page
 * @package OxidEsales\Codeception\Page\Info
 */
class NewsletterSubscription extends Page
{
    // include url of current page
    public $URL = '/en/newsletter/';

    public $userFirstName = '#newsletterFname';

    public $userLastName = '#newsletterLname';

    public $userEmail = '#newsletterUserName';

    public $newsletterSubmitButton = '#newsLetterSubmit';

    public $subscribeCheckbox = '#newsletterSubscribeOn';

    public $unSubscribeCheckbox = '#newsletterSubscribeOff';

    /**
     * Fill fields with user information.
     *
     * @param string $userEmail
     * @param string $userFirstName
     * @param string $userLastName
     *
     * @return $this
     */
    public function enterUserData(string $userEmail = '', string $userFirstName = '', string $userLastName = '')
    {
        $I = $this->user;
        $I->fillField($this->userFirstName, $userFirstName);
        $I->fillField($this->userLastName, $userLastName);
        $I->fillField($this->userEmail, $userEmail);
        return $this;
    }

    /**
     * Submit the newsletter subscription form.
     *
     * @return $this
     */
    public function subscribe()
    {
        $I = $this->user;
        $I->checkOption($this->subscribeCheckbox);
        $I->click($this->newsletterSubmitButton);
        return $this;
    }

    /**
     * Submit the newsletter subscription form to quit
     *
     * @return $this
     */
    public function unsubscribe()
    {
        $I = $this->user;
        $I->checkOption($this->unSubscribeCheckbox);
        $I->click($this->newsletterSubmitButton);
        return $this;
    }
}
