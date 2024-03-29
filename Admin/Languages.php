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

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class Languages extends Page
{
    use FrameLoader;

    public $newLanguageButton = '#btn.new';
    public $activeCheckbox = "//input[@name='editval[active]'][@type='checkbox']";
    public $abbreviationField = "//input[@name='editval[abbr]']";
    public $nameField = "//input[@name='editval[desc]']";

    /**
     * @param string $abbreviation
     * @param string $name
     *
     * @return Languages
     */
    public function createNewLanguage(string $abbreviation, string $name): Languages
    {
        $I = $this->user;

        $I->selectEditFrame();
        $this->loadForm($this->newLanguageButton, $this->nameField);

        $I->amGoingTo('fill and submit the form');
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->abbreviationField, $abbreviation);
        $I->fillField($this->nameField, $name);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->expect('to see the new language in the list');
        $I->retrySelectListFrame();
        $I->waitForText($name);

        return $this;
    }
}
