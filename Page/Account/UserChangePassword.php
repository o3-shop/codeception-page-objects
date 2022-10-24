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

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;
use Facebook\WebDriver\WebDriverKeys;

/**
 * Class for my-password page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserChangePassword extends Page
{
    use AccountMenu;

    // include url of current page
    public $URL = '/en/my-password/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $userOldPassword = '#passwordOld';

    public $userNewPassword = '#passwordNew';

    public $userConfirmNewPassword = '#passwordNewConfirm';

    public $userChangePasswordButton = '#savePass';

    public $errorMessage = '//div[@class="alert alert-danger"]';

    /**
     * Fill the password fields.
     *
     * @param string $oldPassword     The current password
     * @param string $newPassword     The new password
     * @param string $confirmPassword The new password
     *
     * @return $this
     */
    public function fillPasswordFields(string $oldPassword, string $newPassword, string $confirmPassword)
    {
        $I = $this->user;
        $I->pressKey($this->userOldPassword, ['ctrl', 'a'], WebDriverKeys::DELETE);
        $I->pressKey($this->userOldPassword, $oldPassword);
        $I->pressKey($this->userNewPassword, ['ctrl', 'a'], WebDriverKeys::DELETE);
        $I->pressKey($this->userNewPassword, $newPassword);
        $I->pressKey($this->userConfirmNewPassword, ['ctrl', 'a'], WebDriverKeys::DELETE);
        $I->pressKey($this->userConfirmNewPassword, $confirmPassword);
        return $this;
    }

    /**
     * Fill and submit the password fields.
     *
     * @param string $oldPassword     The current password
     * @param string $newPassword     The new password
     * @param string $confirmPassword The new password
     *
     * @return $this
     */
    public function changePassword(string $oldPassword, string $newPassword, string $confirmPassword)
    {
        $I = $this->user;
        $this->fillPasswordFields($oldPassword, $newPassword, $confirmPassword);
        $I->clickWithLeftButton($this->userChangePasswordButton);
        $I->click($this->userChangePasswordButton);
        $I->waitForPageLoad();
        return $this;
    }
}
