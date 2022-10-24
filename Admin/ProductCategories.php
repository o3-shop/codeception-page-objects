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

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class ProductCategories
 *
 * @package OxidEsales\Codeception\Admin
 */
class ProductCategories extends \OxidEsales\Codeception\Page\Page
{
    public $newItemButtonId = '#btn.new';
    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';
    public $categoryInformation = '#transfer';

    /**
     * @param string $categoryName
     *
     * @return ProductCategories
     */
    public function createNewCategory(string $categoryName): ProductCategories
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->newItemButtonId);
        $I->wait(1);

        $I->checkOption($this->activeCategoryCheckbox);
        $I->fillField($this->newCategoryName, $categoryName);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectListFrame();
        $I->waitForText($categoryName);

        return $this;
    }

    /**
     * @return ProductCategories
     */
    public function assignProductsToSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('GENERAL_ASSIGNARTICLES'));

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }

    /**
     * @return ProductCategories
     */
    public function openRightsForSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement($this->categoryInformation, 10);
        $I->selectListFrame();
        $I->click(Translator::translate('tbclcategory_rights'));

        return $this;
    }

    /**
     * @return ProductCategories
     */
    public function assignUserRightsToSeletedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('CATEGORY_RIGHTS_ASSIGNVISIBLE'));

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }
}
