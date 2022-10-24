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

namespace OxidEsales\Codeception\Page;

/**
 * Class Page
 * @package OxidEsales\Codeception\Page
 */
class Page
{
    /**
     * @var \Codeception\Actor
     */
    protected $user;

    /**
     * @var string
     */
    public $URL = '';

    /**
     * @var string
     */
    public $breadCrumb = '#breadcrumb';

    /**
     * Page constructor.
     *
     * @param \Codeception\Actor $I
     */
    public function __construct(\Codeception\Actor $I)
    {
        $this->user = $I;
    }

    /**
     * @param mixed $params
     *
     * @return string
     */
    public function route($params)
    {
        return $this->URL.'/index.php?'.http_build_query($params);
    }

    /**
     * @param string $breadCrumb
     *
     * @return $this
     */
    public function seeOnBreadCrumb(string $breadCrumb)
    {
        $I = $this->user;
        $I->assertContains($breadCrumb, $this->clearNewLines($I->grabTextFrom($this->breadCrumb)));
        return $this;
    }

    /**
     * Removes \n signs and it leading spaces from string. Keeps only single space in the ends of each row.
     *
     * @param string $line Not formatted string (with spaces and \n signs).
     *
     * @return string Formatted string with single spaces and no \n signs.
     */
    private function clearNewLines(string $line)
    {
        return trim(preg_replace("/[\t\r\n]+/", '', $line));
    }
}
