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

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class PerformanceTab extends Page
{
    /** @var string */
    public $disableSaveCartCheckbox = 'confbools[blPerfNoBasketSaving]';

    /** @return PerformanceTab */
    public function enableSaveCart(): PerformanceTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->disableSaveCartCheckbox);
        $I->dontSeeCheckboxIsChecked($this->disableSaveCartCheckbox);
        return $this;
    }

    /** @return PerformanceTab */
    public function disableSaveCart(): PerformanceTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->disableSaveCartCheckbox);
        $I->seeCheckboxIsChecked($this->disableSaveCartCheckbox);
        return $this;
    }

    /** @return PerformanceTab */
    public function save(): PerformanceTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('save');
        $I->waitForPageLoad();
        return $this;
    }
}
