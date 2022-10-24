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

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo;

/**
 * @deprecated class will be removed. Use \OxidEsales\Codeception\Admin\User\ExtendedInformationPage.
 */
trait AdminUserExtendedInfoForm
{
    public $extendedInfoEveningPhoneField = "//input[@name='editval[oxuser__oxprivfon]']";
    public $extendedInfoCelluarPhoneField = "//input[@name='editval[oxuser__oxmobfon]']";
    public $extendedInfoRecievesNewsletterField = "/descendant::input[@name='editnews'][2]";
    public $extendedInfoEmailInvalidField = "/descendant::input[@name='emailfailed'][2]";
    public $extendedInfoCreditRatingField = "//input[@name='editval[oxuser__oxboni]']";
    public $extendedInfoUrlField = "//input[@name='editval[oxuser__oxurl]']";

    /**
     * @param Actor                 $I
     * @param AdminUserExtendedInfo $adminUserExtendedInfo
     */
    public function fillUserExtendedInfoForm(Actor $I, AdminUserExtendedInfo $adminUserExtendedInfo): void
    {
        $fillForm = new FillForm();

        if ($adminUserExtendedInfo->getEveningPhone() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoEveningPhoneField,
                $adminUserExtendedInfo->getEveningPhone());
        }

        if ($adminUserExtendedInfo->getCelluarPhone() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoCelluarPhoneField,
                $adminUserExtendedInfo->getCelluarPhone());
        }

        $fillForm->chooseFormCheckbox($I, $this->extendedInfoRecievesNewsletterField,
            $adminUserExtendedInfo->getRecievesNewsletter());

        $fillForm->chooseFormCheckbox($I, $this->extendedInfoEmailInvalidField,
            $adminUserExtendedInfo->getEmailInvalid());

        if ($adminUserExtendedInfo->getCreditRating() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoCreditRatingField,
                $adminUserExtendedInfo->getCreditRating());
        }

        if ($adminUserExtendedInfo->getUrl() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoUrlField, $adminUserExtendedInfo->getUrl());
        }
    }
}
