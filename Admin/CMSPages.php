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

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class CMSPages
 *
 * @package OxidEsales\Codeception\Admin
 */
class CMSPages extends \OxidEsales\Codeception\Page\Page
{
    public $newCMSButton = '#btn.new';
    public $activeCheckbox = 'editval[oxcontents__oxactive]';
    public $title = 'editval[oxcontents__oxtitle]';
    public $ident = 'editval[oxcontents__oxloadid]';
    public $content = 'oxcontents__oxcontent';
    public $searchForm = '#search';

    /**
     * @param string $title
     * @param string $ident
     * @param string $content
     *
     * @return CMSPages
     */
    public function createNewCMS(string $title, string $ident, string $content): CMSPages
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->newCMSButton);
        $I->wait(3);

        //create new CMS
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->title, $title);
        $I->fillField($this->ident, $ident);
        $I->fillField($this->content, $content);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->wait(3);

        $I->selectListFrame();

        return $this;
    }

    /**
     * @param string $field
     * @param string $value
     */
    public function find(string $field, string $value): void
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);
        $I->selectListFrame();
    }
}
