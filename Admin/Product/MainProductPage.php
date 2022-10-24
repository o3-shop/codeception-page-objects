<?php declare(strict_types=1);
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

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\CoreSetting\SettingsTab;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class MainProductPage extends Page
{
    use ProductList;

    public $activeCheckbox = "//input[@name='editval[oxarticles__oxactive]'][@type='checkbox']";
    public $titleInput = "//input[@name='editval[oxarticles__oxtitle]']";
    public $numberInput = "//input[@name='editval[oxarticles__oxartnum]']";
    public $priceInput = "//input[@name='editval[oxarticles__oxprice]']";

    public $createButton = "//a[@id='btn.new']";
    public $saveButton = "//input[@name='saveArticle']";

    /**
     * @param string      $title
     * @param string|null $number
     * @param int|null    $price
     *
     * @return $this
     */
    public function create(string $title, ?string $number = null, ?int $price = null): self
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createButton);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->titleInput, $title);

        if ($number) {
            $I->fillField($this->numberInput, $number);
        }

        if ($price) {
            $I->fillField($this->priceInput, $price);
        }

        $I->waitForElementClickable($this->saveButton);
        $I->click($this->saveButton);
        $I->selectEditFrame();
        $I->selectListFrame();

        return $this;
    }

    public function save(): MainProductPage
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click($this->saveButton);
        $I->waitForPageLoad();
        return $this;
    }
}
