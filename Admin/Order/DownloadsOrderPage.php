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

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Page\Page;

/**
 * class DownloadsOrderPage
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
class DownloadsOrderPage extends Page
{
    use OrderList;

    public $productNumberInDownloadsTab = "//tr[@id='file.1']/td[1]";
    public $titleInDownloadsTab = "//tr[@id='file.1']/td[2]";
    public $downloadableFileInDownloadsTab = "//tr[@id='file.1']/td[3]";
    public $firstDownloadInDownloadsTab = "//tr[@id='file.1']/td[4]";
    public $lastDownloadInDownloadsTab = "//tr[@id='file.1']/td[5]";
    public $countInDownloadsTab = "//tr[@id='file.1']/td[6]";
    public $maxCountInDownloadsTab = "//tr[@id='file.1']/td[7]";
}
