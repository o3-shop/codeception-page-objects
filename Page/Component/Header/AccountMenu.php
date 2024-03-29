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
use OxidEsales\Codeception\Page\Account\ProductCompare;
use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Account\UserGiftRegistry;
use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Account\UserPasswordReminder;
use OxidEsales\Codeception\Page\Account\UserWishList;
use OxidEsales\Codeception\Page\Account\UserRegistration;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait for account menu widget.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait AccountMenu
{
    public $accountMenuButton = "//div[contains(@class,'service-menu')]/button";

    public $openAccountMenuButton = "//div[contains(@class,'service-menu')]/ul";

    public $userRegistrationLink = '#registerLink';

    public $userLoginName = '#loginEmail';

    public $userLoginPassword = '#loginPasword';

    public $userForgotPasswordButton = '//a[@class="forgotPasswordOpener btn btn-default"]';

    public $userLoginButton = '//div[@id="loginBox"]/button';

    public $userLogoutButton = '';

    public $badLoginError = '#errorBadLogin';

    public $userAccount = '//ul[@id="services"]';

    public $userAccountLink = '//ul[@id="services"]/li[1]/a';

    public $userAccountCompareListLink = '//ul[@id="services"]/li[2]/a';

    public $userAccountWishListLink = '//ul[@id="services"]/li[3]/a';

    public $userAccountGiftRegistryLink = '//ul[@id="services"]/li[4]/a';

    public $userAccountCompareListText = '//ul[@id="services"]/li[2]';

    public $userAccountWishListText = '//ul[@id="services"]/li[3]';

    public $userAccountGiftRegistryText = '//ul[@id="services"]/li[4]';

    /**
     * Opens open-account page.
     *
     * @return UserRegistration
     */
    public function openUserRegistrationPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userRegistrationLink);
        $I->click($this->userRegistrationLink);
        $userRegistrationPage = new UserRegistration($I);
        $breadCrumb = Translator::translate('PAGE_TITLE_REGISTER');
        $userRegistrationPage->seeOnBreadCrumb($breadCrumb);
        return $userRegistrationPage;
    }

    /**
     * Opens forgot-password page.
     *
     * @return UserPasswordReminder
     */
    public function openUserPasswordReminderPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userForgotPasswordButton);
        $I->click($this->userForgotPasswordButton);
        $userPasswordReminderPage = new UserPasswordReminder($I);
        $breadCrumb = Translator::translate('FORGOT_PASSWORD');
        $userPasswordReminderPage->seeOnBreadCrumb($breadCrumb);
        return $userPasswordReminderPage;
    }

    /**
     *
     * @param string $userName
     * @param string $userPassword
     *
     * @return $this
     */
    public function loginUser(string $userName, string $userPassword)
    {
        $I = $this->user;
        // logging in
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userLoginName);
        $I->fillField($this->userLoginName, $userName);
        $I->fillField($this->userLoginPassword, $userPassword);
        $I->click($this->userLoginButton);
        $I->waitForPageLoad();
        Context::setActiveUser($userName);
        return $this;
    }

    /**
     * @return $this
     */
    public function logoutUser()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForText(Translator::translate('LOGOUT'));
        $I->click(Translator::translate('LOGOUT'));
        $I->waitForPageLoad();
        Context::resetActiveUser();
        return $this;
    }

    /**
     * Opens my-account page.
     *
     * @return UserAccount
     */
    public function openAccountPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountLink);
        $I->click($this->userAccountLink);
        $I->waitForPageLoad();
        return new UserAccount($I);
    }

    /**
     * Opens my-gift-registry page.
     *
     * @return UserGiftRegistry
     */
    public function openUserGiftRegistryPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountGiftRegistryLink);
        $I->click($this->userAccountGiftRegistryLink);
        $I->waitForPageLoad();
        $userGiftRegistryPage = new UserGiftRegistry($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_GIFT_REGISTRY');
        $userGiftRegistryPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_WISHLIST'), $userGiftRegistryPage->headerTitle);
        return $userGiftRegistryPage;
    }

    /**
     * Opens my-wish-list page.
     *
     * @return UserWishList
     */
    public function openUserWishListPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountWishListLink);
        $I->click($this->userAccountWishListLink);
        $I->waitForPageLoad();
        $userWishListPage = new UserWishList($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_WISH_LIST');
        $userWishListPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NOTICELIST'), $userWishListPage->headerTitle);
        return $userWishListPage;
    }

    /**
     * Opens my-product-comparison page.
     *
     * @return ProductCompare
     */
    public function openProductComparePage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountCompareListLink);
        $I->click($this->userAccountCompareListLink);
        $I->waitForPageLoad();
        $productComparePage = new ProductCompare($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('PRODUCT_COMPARISON');
        $productComparePage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('COMPARE'), $productComparePage->headerTitle);
        return $productComparePage;
    }

    /**
     * TODO: should we use trait here?
     * @return UserLogin
     */
    public function openUserLoginPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountLink);
        $I->click($this->userAccountLink);
        $I->waitForPageLoad();
        $userLoginPage = new UserLogin($I);
        $breadCrumb = Translator::translate('LOGIN');
        $userLoginPage->seeOnBreadCrumb($breadCrumb);
        return $userLoginPage;
    }

    /**
     * Opens my-account page.
     *
     * @return $this
     */
    public function openAccountMenu()
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->waitForElementVisible($this->accountMenuButton);
        $I->click($this->accountMenuButton);
        $I->waitForElementClickable($this->openAccountMenuButton);
        return $this;
    }

    /**
     * @return $this
     */
    public function closeAccountMenu()
    {
        $I = $this->user;
        $I->waitForElementVisible($this->accountMenuButton);
        $I->click($this->accountMenuButton);
        $I->waitForElementNotVisible($this->openAccountMenuButton);
        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function checkCompareListItemCount(int $count)
    {
        $I = $this->user;
        $this->openAccountMenu();
        $cnt = ($count) ? ' '.$count : '';
        $I->waitForText(Translator::translate('MY_PRODUCT_COMPARISON'));
        $I->see(Translator::translate('MY_PRODUCT_COMPARISON').$cnt, $this->userAccountCompareListText);
        $this->closeAccountMenu();
        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function checkWishListItemCount(int $count)
    {
        $I = $this->user;
        $cnt = ($count) ? ' '.$count : '';
        $I->waitForText(Translator::translate('MY_WISH_LIST'));
        $I->see(Translator::translate('MY_WISH_LIST').$cnt, $this->userAccountWishListText);
        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function checkGiftRegistryItemCount(int $count)
    {
        $I = $this->user;
        $cnt = ($count) ? ' '.$count : '';
        $I->waitForText(Translator::translate('MY_GIFT_REGISTRY'));
        $I->see(Translator::translate('MY_GIFT_REGISTRY').$cnt, $this->userAccountGiftRegistryText);
        return $this;
    }
}
