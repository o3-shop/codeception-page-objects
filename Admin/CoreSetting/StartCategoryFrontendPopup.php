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

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class StartCategoryFrontendPopup extends Page
{
    public string $defaultCategoryLabelContainer = 'td#_defcat';
    public string $categoryNameSearchFilter = "//input[@name='_0']";
    public string $categoryDescriptionSearchFilter = "//input[@name='_1']";
    public string $datTableFirstRow = "div#container1_c > table > tbody.yui-dt-data > tr:first-child";
    public string $dateTableSelectedRow = '.yui-dt-selected';

    public function selectCategory(string $categoryName): StartCategoryFrontendPopup
    {
        $I = $this->user;

        $I->fillField($this->categoryNameSearchFilter, $categoryName);
        $I->waitForElementNotVisible($this->datTableFirstRow . $this->dateTableSelectedRow);
        $I->waitForText($categoryName, null, $this->datTableFirstRow);
        $I->click($this->datTableFirstRow);
        $I->waitForElementVisible($this->datTableFirstRow . $this->dateTableSelectedRow);
        $I->click(Translator::translate('SHOP_CONFIG_ASSIGNDEFAULTCAT'));
        $I->waitForDocumentReadyState();
        $I->waitForText($this->getDefaultCategoryLabel($categoryName), null, $this->defaultCategoryLabelContainer);

        return $this;
    }

    public function unsetCategory(): StartCategoryFrontendPopup
    {
        $I = $this->user;

        $I->waitForElementVisible($this->defaultCategoryLabelContainer);
        $I->click(Translator::translate('SHOP_CONFIG_UNASSIGNDEFAULTCAT'));
        $I->waitForDocumentReadyState();
        $I->waitForElementNotVisible($this->defaultCategoryLabelContainer);

        return $this;
    }

    private function getDefaultCategoryLabel(string $categoryName): string
    {
        return sprintf("%s: %s", Translator::translate('SHOP_CONFIG_ASSIGNEDDEFAULTCAT'), $categoryName);
    }
}
