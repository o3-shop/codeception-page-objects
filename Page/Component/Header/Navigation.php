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

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Page\Home;
use OxidEsales\Codeception\Page\Lists\ProductList;

/**
 * Trait for the navigation widget in the header.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait Navigation
{
    public $homeLink = '//ul[@id="navigation"]/li[1]/a';

    /**
     * @return Home
     */
    public function openHomePage()
    {
        $I = $this->user;
        $I->click($this->homeLink);
        $I->waitForPageLoad();
        return new Home($I);
    }

    /**
     * Open selected category page.
     *
     * @param string $category
     *
     * @return ProductList
     */
    public function openCategoryPage(string $category)
    {
        $I = $this->user;
        $I->click(['link' => $category]);
        return new ProductList($I);
    }
}
