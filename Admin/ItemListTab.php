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

/**
 * Class ListItemTab
 *
 * General admin list item tab click page.
 * This class is the base that should be extended.
 *
 * tabHref attribute should have correct the tab link href value:
 * <a href="#someclassname">, in this case we have "#someclassname" as tabHref.
 *
 * @package OxidEsales\Codeception\Admin
 */
abstract class ItemListTab extends \OxidEsales\Codeception\Page\Page
{
    /**
     * @var string
     */
    protected $tabHref = '';

    /**
     * @var string
     */
    public $tabSelector = "//div[@class='tabs']//a[@href='%s']";

    /**
     * @return string
     */
    public function getTabHref(): string
    {
        return $this->tabHref;
    }

    /**
     * @return string
     */
    public function getTabSelector(): string
    {
        return sprintf($this->tabSelector, $this->getTabHref());
    }
}
