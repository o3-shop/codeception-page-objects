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

namespace OxidEsales\Codeception\Step;

use Codeception\Actor;
use OxidEsales\Codeception\Page\Details\ProductDetails;

/**
 * Class ProductNavigation
 * @package OxidEsales\Codeception\Step
 */
class ProductNavigation extends Step
{
    /**
     * Open product details page.
     *
     * @param string $productId The Id of the product
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage(string $productId)
    {
        $I = $this->user;
        $productDetailsPage = new ProductDetails($I);
        $detailsPageUrl = $productDetailsPage->route($productId);

        $detailsPageUrl = $this->appendParametersToUrl($I, $detailsPageUrl);

        $I->amOnPage($detailsPageUrl);
        return $productDetailsPage;
    }

    /**
     * Append required parameters to the url, like force_sid.
     *
     * @param Actor  $I   Actor
     * @param string $url The url
     *
     * @return string
     */
    private function appendParametersToUrl(Actor $I, string $url): string
    {
        $elementName = 'input[name=force_sid]';
        if ($I->seePageHasElement($elementName) && $I->grabValueFrom($elementName)) {
            $force_sid = $I->grabValueFrom($elementName);
            $url .= '&' . http_build_query(['force_sid' => $force_sid]);
        }

        return $url;
    }
}
