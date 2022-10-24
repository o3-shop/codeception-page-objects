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

namespace OxidEsales\Codeception\Page\Component;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Module\Translation\Translator;

trait Modal
{
    private $confirmDeletionBtn = '.modal-dialog .modal-content button.btn-danger';
    private $deleteShippingAddressBtn = '//*[@id="delete_shipping_address_%s"]/div/div/div[3]/button[2]';

    public function confirmDeletion(): void
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->seeAndClick(
            Locator::contains($this->confirmDeletionBtn, Translator::translate('DD_DELETE'))
        );
    }

    public function confirmShippingAddressDeletion($position): void
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->retryClick(
            Locator::contains(
                sprintf($this->deleteShippingAddressBtn, $position),
                Translator::translate('DD_DELETE')
            )
        );
    }
}
