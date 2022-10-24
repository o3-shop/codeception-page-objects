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

namespace OxidEsales\Codeception\Admin\Product\Popup;

use Facebook\WebDriver\WebDriverKeys;
use OxidEsales\Codeception\Page\Page;

class AssignSelectionListsPopup extends Page
{
    public $unassignedList = '#container1';
    public $assignedList = '#container2';
    public $titleFilter = 'input[name="_0"]';
    public $firstRow = '.yui-dt-data tr.yui-dt-first';

    /**
     * @param string $itemTitle
     *
     * @return $this
     */
    public function assignSelectionByTitle(string $itemTitle): self
    {
        $I = $this->user;

        $I->fillField("$this->unassignedList $this->titleFilter", $itemTitle);
        $I->pressKey("$this->unassignedList $this->titleFilter", WebDriverKeys::ENTER);
        $I->wait(3);
        $I->retryDragAndDrop("$this->unassignedList $this->firstRow", $this->assignedList);
        $I->wait(3);

        return $this;
    }
}
