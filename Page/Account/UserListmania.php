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

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\Component\AccountNavigation;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for my-listmania-list page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserListmania extends Page
{
    use AccountNavigation, AccountMenu;

    // include url of current page
    public $URL = '/en/my-listmania-list/';

    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $listmaniaTitleField = 'recomm_title';

    public $listmaniaAuthorField = 'recomm_author';

    public $listmaniaDescriptionField = 'recomm_desc';

    public $listmaniaListTitle = '//ul[@id="recommendationsLists"]//a[@title="%s"]';

    /**
     * @param string $title
     * @param string $author
     * @param string $description
     *
     * @return $this
     */
    public function createNewList(string $title, string $author = '', string $description = '')
    {
        $I = $this->user;
        $I->fillField($this->listmaniaTitleField, $title);
        if (!empty($author)) {
            $I->fillField($this->listmaniaAuthorField, $author);
        }
        $I->fillField($this->listmaniaDescriptionField, $description);
        $I->click(Translator::translate('SAVE'));
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function openListByTitle(string $title)
    {
        $I = $this->user;
        $I->click(sprintf($this->listmaniaListTitle, $title));
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @param string $title
     * @param string $author
     * @param string $description
     *
     * @return $this
     */
    public function seeListData(string $title, string $author = '', string $description = '')
    {
        $I = $this->user;
        $I->see($description);
        $I->see($title . ' ' . Translator::translate('LIST_BY') . ' ' . $author);
        return $this;
    }
}
