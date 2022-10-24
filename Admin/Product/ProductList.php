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

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Module\Translation\Translator;

trait ProductList
{
    public $searchNumberInput = "//input[@name='where[oxarticles][oxartnum]']";
    public $languageSelect = "//select[@name='changelang']";
    public $searchForm = '#search';

    /**
     * @param string $language
     *
     * @return MainProductPage
     */
    public function switchLanguage(string $language): MainProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->selectOption($this->languageSelect, $language);
        $I->seeOptionIsSelected($this->languageSelect, $language);
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainProductPage($I);
    }

    /**
     * @param string $field
     * @param string $value
     *
     * @return MainProductPage
     */
    public function find(string $field, string $value): MainProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainProductPage($I);
    }

    /** @return SelectionProductPage */
    public function openSelectionTab(): SelectionProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_attribute'));
        $I->selectEditFrame();

        return new SelectionProductPage($I);
    }

    /** @return VariantsProductPage */
    public function openVariantsTab(): VariantsProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_variant'));
        $I->selectEditFrame();

        return new VariantsProductPage($I);
    }

    /** @return DownloadsProductPage */
    public function openDownloadsTab(): DownloadsProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_files'));
        $I->selectListFrame();
        $I->selectEditFrame();

        return new DownloadsProductPage($I);
    }
}
