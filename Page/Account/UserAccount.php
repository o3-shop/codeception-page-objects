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

use OxidEsales\Codeception\Page\Account\Component\AccountNavigation;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for my-account page
 *
 * @package OxidEsales\Codeception\Page\Account
 */
class UserAccount extends Page
{

    use AccountMenu, AccountNavigation;

    // include url of current page
    public $URL = '/en/my-account/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $dashboardChangePasswordPanelHeader = '#linkAccountPassword';

    public $dashboardCompareListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[1]';

    public $dashboardCompareListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[2]';

    public $dashboardWishListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[1]';

    public $dashboardWishListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[2]';

    public $dashboardGiftRegistryPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[2]/div[1]';

    public $dashboardGiftRegistryPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[2]/div[2]';

    public $dashboardListmaniaPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[4]/div[1]';

    public $dashboardListmaniaPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[4]/div[2]';

    public $dashboardOrderHistoryHeader = '#linkAccountOrder';

    /**
     * @return UserLogin
     */
    public function logoutUserInAccountPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(Translator::translate('LOGOUT'));
        $userLoginPage = new UserLogin($I);
        $breadCrumb = Translator::translate('LOGIN');
        $userLoginPage->seeOnBreadCrumb($breadCrumb);

        return $userLoginPage;
    }

    /**
     * Opens my-password page
     *
     * @return UserChangePassword
     */
    public function openChangePasswordPage()
    {
        $I = $this->user;
        $I->click($this->dashboardChangePasswordPanelHeader);
        $userChangePasswordPage = new UserChangePassword($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT') . Translator::translate('CHANGE_PASSWORD');
        $userChangePasswordPage->seeOnBreadCrumb($breadCrumb);

        return $userChangePasswordPage;
    }

    /**
     * Opens order-hisotry page.
     *
     * @return UserOrderHistory
     */
    public function openOrderHistory()
    {
        $I = $this->user;
        $I->click($this->dashboardOrderHistoryHeader);
        $userOrderHistoryPage = new UserOrderHistory($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT') . Translator::translate('ORDER_HISTORY');
        $userOrderHistoryPage->seeOnBreadCrumb($breadCrumb);

        return $userOrderHistoryPage;
    }
}
