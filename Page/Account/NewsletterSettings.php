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

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for account_newsletter page
 * @package OxidEsales\Codeception\Page\Account
 */
class NewsletterSettings extends Page
{
    // include url of current page
    public $URL = '/index.php?lang=1&cl=account_newsletter';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $newsletterStatusSelect = '//button[@data-id="status"]';

    public $newsletterSubscribeButton = '#newsletterSettingsSave';

    /**
     * Responsible for newsletter subscription
     *
     * @return $this
     */
    public function subscribeNewsletter()
    {
        $I = $this->user;
        $I->click($this->newsletterStatusSelect);
        $I->waitForText(Translator::translate('YES'));
        $I->click(Translator::translate('YES'));
        $I->retryClick($this->newsletterSubscribeButton);
        $I->waitForPageLoad();
        $I->waitForText(Translator::translate('MESSAGE_NEWSLETTER_SUBSCRIPTION_SUCCESS'));
        return $this;
    }

    /**
     * Responsible for newsletter unsubscription
     *
     * @return $this
     */
    public function unSubscribeNewsletter()
    {
        $I = $this->user;
        $I->click($this->newsletterStatusSelect);
        $I->waitForText(Translator::translate('NO'));
        $I->click(Translator::translate('NO'));
        $I->retryClick($this->newsletterSubscribeButton);
        $I->waitForPageLoad();
        $I->waitForText(Translator::translate('MESSAGE_NEWSLETTER_SUBSCRIPTION_CANCELED'));
        return $this;
    }

    /**
     * Check if newsletter is subscribed
     *
     * @return $this
     */
    public function seeNewsletterSubscribed()
    {
        $I = $this->user;
        $I->see(Translator::translate('YES'), $this->newsletterStatusSelect);
        return $this;
    }

    /**
     * Check if newsletter is unsubscribed
     *
     * @return $this
     */
    public function seeNewsletterUnSubscribed()
    {
        $I = $this->user;
        $I->see(Translator::translate('NO'), $this->newsletterStatusSelect);
        return $this;
    }
}
