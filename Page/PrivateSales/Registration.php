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

namespace OxidEsales\Codeception\Page\PrivateSales;

use OxidEsales\Codeception\Page\Component\UserForm;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for open-account page
 * @package OxidEsales\Codeception\Page\Account
 */
class Registration extends Page
{
    use UserForm;

    // include url of current page
    public $URL = '/en/open-account';

    //save form button
    public $saveFormButton = '#accUserSaveTop';

    public $confirmAGBOption = '#orderConfirmAgbBottom';

    public $confirmNewsletter = 'blnewssubscribed';

    /**
     * @return $this
     */
    public function registerUser()
    {
        $I = $this->user;
        $I->click($this->saveFormButton);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function confirmAGB()
    {
        $I = $this->user;
        $I->checkOption($this->confirmAGBOption);
        return $this;
    }

    /**
     * @return $this
     */
    public function confirmNewsletterSubscription()
    {
        $I = $this->user;
        $I->checkOption($this->confirmNewsletter);
        return $this;
    }
}
