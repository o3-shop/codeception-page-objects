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

use OxidEsales\Codeception\Admin\Product\Popup\AssignSelectionListsPopup;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class SelectionProductPage extends Page
{
    use ProductList;

    public $assignSelectionListButton = 'input.edittext[type="button"][value="%s"]';
    public $assignSelectionListButtonValue = 'ARTICLE_ATTRIBUTE_ASSIGNSELECTLIST';
    public $unassignedSelectionsListTitle = 'ARTICLE_ATTRIBUTE_NOSELLIST';
    public $unassignedList = '#container1';
    public $assignedList = '#container2';

    /** @return AssignSelectionListsPopup */
    public function openAssignSelectionListPopup(): AssignSelectionListsPopup
    {
        $I = $this->user;

        $assignSelectionListButtonSelector = sprintf(
            $this->assignSelectionListButton,
            Translator::translate($this->assignSelectionListButtonValue)
        );

        $I->click($assignSelectionListButtonSelector);
        $I->waitForDocumentReadyState();
        $I->switchToNextTab();
        $I->waitForDocumentReadyState();
        $I->maximizeWindow();

        $I->waitForText(Translator::translate($this->unassignedSelectionsListTitle));
        $I->waitForElement($this->unassignedList);
        $I->waitForElement($this->assignedList);

        return new AssignSelectionListsPopup($I);
    }
}
