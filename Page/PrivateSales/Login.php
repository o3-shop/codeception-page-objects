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

use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Page;

class Login extends Page
{
    public $URL = '/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $forgotPassword = '#forgotPasswordLink';

    public $userAccountLoginName = '#loginUser';

    public $userAccountLoginPassword = '#loginPwd';

    public $userAccountLoginButton = '#loginButton';

    public $userForgotPasswordLink = '#forgotPasswordLink';

    public $confirmAGBOption = 'ord_agb';

    public $confirmAGBButton = '//form[@id="private-sales-login"]//button';

    public $userRegistration = '#openAccountLink';

    public function login(string $userName, string $userPassword)
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);
        $I->waitForPageLoad();
        return $this;
    }

    public function openUserPasswordReminderPage()
    {
        $I = $this->user;
        $I->click($this->forgotPassword);
        $I->waitForPageLoad();
        return new UserPasswordReminder($I);
    }

    public function confirmAGB()
    {
        $I = $this->user;
        $I->checkOption($this->confirmAGBOption);
        $I->click($this->confirmAGBButton);
        $I->waitForPageLoad();
        return new UserAccount($I);
    }

    public function openRegistrationPage()
    {
        $I = $this->user;
        $I->click($this->userRegistration);
        $I->waitForPageLoad();
        return new Registration($I);
    }
}
