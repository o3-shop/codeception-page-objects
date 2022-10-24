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

namespace OxidEsales\Codeception\Admin\DataObject;

/**
 * Class AdminUserExtendedInfo
 */
class AdminUserExtendedInfo
{
    /** @var string */
    private $eveningPhone;

    /** @var string */
    private $celluarPhone;

    /** @var bool */
    private $recievesNewsletter = false;

    /** @var bool */
    private $emailInvalid = false;

    /** @var string */
    private $creditRating;

    /** @var string */
    private $url;

    /**
     * @return string|null
     */
    public function getEveningPhone(): ?string
    {
        return $this->eveningPhone;
    }

    /**
     * @param string $eveningPhone
     */
    public function setEveningPhone(string $eveningPhone): void
    {
        $this->eveningPhone = $eveningPhone;
    }

    /**
     * @return string|null
     */
    public function getCelluarPhone(): ?string
    {
        return $this->celluarPhone;
    }

    /**
     * @param string $celluarPhone
     */
    public function setCelluarPhone(string $celluarPhone): void
    {
        $this->celluarPhone = $celluarPhone;
    }

    /**
     * @return bool
     */
    public function getRecievesNewsletter(): bool
    {
        return $this->recievesNewsletter;
    }

    /**
     * @param bool $recievesNewsletter
     */
    public function setRecievesNewsletter(bool $recievesNewsletter): void
    {
        $this->recievesNewsletter = $recievesNewsletter;
    }

    /**
     * @return bool
     */
    public function getEmailInvalid(): bool
    {
        return $this->emailInvalid;
    }

    /**
     * @param bool $emailInvalid
     */
    public function setEmailInvalid(bool $emailInvalid): void
    {
        $this->emailInvalid = $emailInvalid;
    }

    /**
     * @return string|null
     */
    public function getCreditRating(): ?string
    {
        return $this->creditRating;
    }

    /**
     * @param string $creditRating
     */
    public function setCreditRating(string $creditRating): void
    {
        $this->creditRating = $creditRating;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
